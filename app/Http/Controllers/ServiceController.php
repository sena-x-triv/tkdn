<?php

namespace App\Http\Controllers;

use App\Models\EstimationItem;
use App\Models\Hpp;
use App\Models\HppItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['project', 'items', 'project.hpps'])
            ->latest()
            ->paginate(10);

        return view('service.index', compact('services'));
    }

    public function create()
    {
        $projects = Project::where('status', '!=', 'completed')->get();
        $serviceTypes = Service::getServiceTypes();

        return view('service.create', compact('projects', 'serviceTypes'));
    }

    /**
     * Get HPP data for AJAX request
     */
    public function getHppData(Request $request)
    {
        $projectId = $request->project_id;

        if (! $projectId) {
            return response()->json(['error' => 'Project ID diperlukan'], 400);
        }

        // Ambil semua HPP untuk project ini
        $hpps = Hpp::where('project_id', $projectId)
            ->with(['items' => function ($query) {
                $query->orderBy('tkdn_classification')
                    ->orderBy('item_number');
            }])
            ->get();

        if ($hpps->isEmpty()) {
            return response()->json(['error' => 'Tidak ada HPP ditemukan untuk project ini'], 404);
        }

        $hppData = [];
        foreach ($hpps as $hpp) {
            $hppData[] = [
                'id' => $hpp->id,
                'code' => $hpp->code,
                'total_cost' => $hpp->grand_total,
                'items_count' => $hpp->items->count(),
                'project_name' => $hpp->project->name ?? 'N/A',
                'project_code' => $hpp->project->code ?? 'N/A',
                'tkdn_breakdown' => $hpp->items->groupBy('tkdn_classification')->map(function ($items, $classification) {
                    return [
                        'classification' => $classification,
                        'count' => $items->count(),
                        'total_cost' => $items->sum('total_price'),
                    ];
                }),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $hppData,
        ]);
    }

    /**
     * Generate TKDN forms dari data HPP
     */
    private function generateTkdnFormsFromHpp(Service $service, Hpp $hpp)
    {
        // Generate form sesuai service type
        switch ($service->service_type) {
            case 'project':
                // Form 3.1 - Jasa Manajemen Proyek dan Perekayasaan
                $this->createTkdnFormFromHpp($service, $hpp, '3.1', 'Jasa Manajemen Proyek dan Perekayasaan');
                break;

            case 'equipment':
                // Form 3.2 - Jasa Alat Kerja dan Peralatan
                $this->createTkdnFormFromHpp($service, $hpp, '3.2', 'Jasa Alat Kerja dan Peralatan');
                break;

            case 'construction':
                // Form 3.3 - Jasa Konstruksi dan Pembangunan
                $this->createTkdnFormFromHpp($service, $hpp, '3.3', 'Jasa Konstruksi dan Pembangunan');
                break;
        }

        // Generate Form 3.4 - Jasa Konsultasi dan Pengawasan (selalu ada)
        $this->createTkdnFormFromHpp($service, $hpp, '3.4', 'Jasa Konsultasi dan Pengawasan');

        // Form 3.5 adalah rangkuman dari semua form
        $service->update(['tkdn_classification' => '3.5']);

        // Recalculate totals
        $service->calculateTotals();
    }

    /**
     * Create TKDN form dari data HPP dengan AHS items
     */
    private function createTkdnFormFromHpp(Service $service, Hpp $hpp, string $formNumber, string $formTitle)
    {
        // 1. Ambil HPP items sesuai tkdn_classification
        $hppItems = $hpp->items()->where('tkdn_classification', $formNumber)->get();

        $itemNumber = 1;

        foreach ($hppItems as $hppItem) {
            // 2. Ambil data AHS items berdasarkan HPP item (estimation_item)
            if ($hppItem->estimation_item_id) {
                $estimationItem = $hppItem->estimationItem;
                if ($estimationItem) {
                    // Ambil estimation dari estimation_item
                    $estimation = $estimationItem->estimation;
                    $ahsItems = $estimation->items;

                    // 3. Insert data AHS items ke table service_items
                    foreach ($ahsItems as $ahsItem) {
                        // Tentukan TKDN percentage berdasarkan form dan kategori
                        $tkdnPercentage = $this->calculateTkdnPercentage($formNumber, $ahsItem->category);

                        // Hitung biaya berdasarkan TKDN percentage
                        $totalCost = $ahsItem->total_price;
                        $domesticCost = $totalCost * ($tkdnPercentage / 100);
                        $foreignCost = $totalCost - $domesticCost;

                        ServiceItem::create([
                            'service_id' => $service->id,
                            'estimation_item_id' => $ahsItem->id,
                            'item_number' => $itemNumber++,
                            'tkdn_classification' => $formNumber,
                            'description' => $this->getAhsItemDescription($ahsItem),
                            'qualification' => $this->getAhsItemQualification($ahsItem),
                            'nationality' => 'WNI', // Default WNI
                            'tkdn_percentage' => $tkdnPercentage,
                            'quantity' => $ahsItem->coefficient,
                            'duration' => $hppItem->duration,
                            'duration_unit' => $hppItem->duration_unit,
                            'wage' => $ahsItem->unit_price,
                            'domestic_cost' => $domesticCost,
                            'foreign_cost' => $foreignCost,
                            'total_cost' => $totalCost,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Hitung TKDN percentage berdasarkan form dan kategori AHS
     */
    private function calculateTkdnPercentage(string $formNumber, string $category): float
    {
        // Form 3.1: Jasa Manajemen Proyek - Default 100% TKDN
        if ($formNumber === '3.1') {
            return 100.0;
        }

        // Form 3.2: Jasa Alat Kerja - Default 0% TKDN
        if ($formNumber === '3.2') {
            return 0.0;
        }

        // Form 3.3: Jasa Konstruksi - Default 0% TKDN
        if ($formNumber === '3.3') {
            return 0.0;
        }

        // Form 3.4: Jasa Konsultasi - Default 0% TKDN
        if ($formNumber === '3.4') {
            return 0.0;
        }

        // Default berdasarkan kategori
        return match ($category) {
            'worker' => 100.0,    // Pekerja WNI
            'material' => 0.0,    // Material impor
            'equipment' => 0.0,   // Equipment impor
            default => 50.0,      // Default 50%
        };
    }

    /**
     * Generate description untuk AHS item
     */
    private function getAhsItemDescription(EstimationItem $ahsItem): string
    {
        return match ($ahsItem->category) {
            'worker' => $ahsItem->worker->name ?? $ahsItem->code,
            'material' => $ahsItem->material->name ?? $ahsItem->code,
            'equipment' => $ahsItem->equipment->name ?? $ahsItem->code,
            default => $ahsItem->code,
        };
    }

    /**
     * Generate qualification untuk AHS item
     */
    private function getAhsItemQualification(EstimationItem $ahsItem): ?string
    {
        return match ($ahsItem->category) {
            'worker' => $ahsItem->worker->position ?? null,
            'material' => $ahsItem->material->specification ?? null,
            'equipment' => $ahsItem->equipment->type ?? null,
            default => null,
        };
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hpp_id' => 'required|exists:hpps,id',
            'service_type' => 'required|in:project,equipment,construction',
        ]);

        try {
            $service = null;

            DB::transaction(function () use ($validated, &$service) {
                // Ambil data HPP dengan project
                $hpp = Hpp::with(['items', 'project'])->findOrFail($validated['hpp_id']);

                // Auto-generate service name dari HPP code
                $serviceName = 'Service TKDN - '.$hpp->code;

                $service = Service::create([
                    'project_id' => $hpp->project_id,
                    'service_name' => $serviceName,
                    'service_type' => $validated['service_type'], // Gunakan service_type dari form
                    'provider_name' => $hpp->project->company ?? 'PT Konstruksi Maju',
                    'provider_address' => $hpp->project->address ?? 'Jl. Sudirman No. 123, Jakarta Pusat',
                    'user_name' => $hpp->project->client ?? 'PT Pembangunan Indonesia',
                    'document_number' => 'DOC-'.$hpp->code,
                    'status' => 'draft',
                ]);

                // Generate TKDN forms otomatis dari data HPP
                $this->generateTkdnFormsFromHpp($service, $hpp);
            });

            return redirect()->route('service.show', $service)
                ->with('success', 'Service berhasil dibuat dan form TKDN telah di-generate otomatis dari HPP.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan service: '.$e->getMessage());
        }
    }

    public function show(Service $service)
    {
        $service->load(['project', 'items']);

        return view('service.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $projects = Project::where('status', '!=', 'completed')->get();
        $serviceTypes = Service::getServiceTypes();
        $service->load(['project', 'items']);

        return view('service.edit', compact('service', 'projects', 'serviceTypes'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'service_name' => 'required|string|max:255',
            'service_type' => 'required|in:project,equipment,construction',
            'provider_name' => 'nullable|string|max:255',
            'provider_address' => 'nullable|string',
            'user_name' => 'nullable|string|max:255',
            'document_number' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.qualification' => 'nullable|string|max:255',
            'items.*.nationality' => 'required|in:WNI,WNA',
            'items.*.tkdn_percentage' => 'required|numeric|min:0|max:100',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.duration' => 'required|numeric|min:0',
            'items.*.duration_unit' => 'required|string|max:10',
            'items.*.wage' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($validated, $service) {
                $service->update([
                    'project_id' => $validated['project_id'],
                    'service_name' => $validated['service_name'],
                    'service_type' => $validated['service_type'],
                    'provider_name' => $validated['provider_name'],
                    'provider_address' => $validated['provider_address'],
                    'user_name' => $validated['user_name'],
                    'document_number' => $validated['document_number'],
                ]);

                // Hapus item lama
                $service->items()->delete();

                // Buat item baru
                foreach ($validated['items'] as $index => $item) {
                    $serviceItem = ServiceItem::create([
                        'service_id' => $service->id,
                        'item_number' => $index + 1,
                        'description' => $item['description'],
                        'qualification' => $item['qualification'],
                        'nationality' => $item['nationality'],
                        'tkdn_percentage' => $item['tkdn_percentage'],
                        'quantity' => $item['quantity'],
                        'duration' => $item['duration'],
                        'duration_unit' => $item['duration_unit'],
                        'wage' => $item['wage'],
                    ]);

                    $serviceItem->calculateCosts();
                }

                $service->calculateTotals();
            });

            return redirect()->route('service.index')
                ->with('success', 'Jasa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui jasa.');
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();

            return redirect()->route('service.index')
                ->with('success', 'Jasa berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus jasa.');
        }
    }

    public function submit(Service $service)
    {
        $service->update(['status' => 'submitted']);

        return redirect()->route('service.show', $service)
            ->with('success', 'Jasa berhasil diajukan.');
    }

    public function approve(Service $service)
    {
        $service->update(['status' => 'approved']);

        return redirect()->route('service.show', $service)
            ->with('success', 'Jasa berhasil disetujui.');
    }

    public function reject(Service $service)
    {
        $service->update(['status' => 'rejected']);

        return redirect()->route('service.show', $service)
            ->with('success', 'Jasa berhasil ditolak.');
    }

    public function generate(Service $service)
    {
        try {
            DB::transaction(function () use ($service) {
                // Generate semua form TKDN berdasarkan service type
                $this->generateTkdnForms($service);

                // Update status service menjadi generated
                $service->update(['status' => 'generated']);
            });

            return redirect()->route('service.show', $service)
                ->with('success', 'Form TKDN berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuat form TKDN: '.$e->getMessage());
        }
    }

    private function generateTkdnForms(Service $service)
    {
        // Generate Form 3.1 - Jasa Manajemen Proyek dan Perekayasaan
        if ($service->service_type === 'project') {
            $this->createTkdnForm($service, '3.1', 'Jasa Manajemen Proyek dan Perekayasaan');
        }

        // Generate Form 3.2 - Jasa Alat Kerja dan Peralatan
        if ($service->service_type === 'equipment') {
            $this->createTkdnForm($service, '3.2', 'Jasa Alat Kerja dan Peralatan');
        }

        // Generate Form 3.3 - Jasa Konstruksi dan Pembangunan
        if ($service->service_type === 'construction') {
            $this->createTkdnForm($service, '3.3', 'Jasa Konstruksi dan Pembangunan');
        }

        // Generate Form 3.4 - Jasa Konsultasi dan Pengawasan
        $this->createTkdnForm($service, '3.4', 'Jasa Konsultasi dan Pengawasan');

        // Form 3.5 adalah rangkuman dari semua form, tidak perlu generate data baru
        // Field tkdn_classification akan diupdate ke '3.5' untuk menandakan sudah complete
        $service->update(['tkdn_classification' => '3.5']);
    }

    private function createTkdnForm(Service $service, string $formNumber, string $formTitle)
    {
        // Ambil data HPP dengan tkdn_classification yang sesuai
        $hppItems = $this->getHppItemsByTkdnClassification($service->project_id, $formNumber);

        // Update field tkdn_classification
        $service->update([
            'tkdn_classification' => $formNumber,
        ]);

        // Generate service items berdasarkan data HPP
        $this->generateServiceItemsFromHpp($service, $hppItems, $formNumber);
    }

    private function getHppItemsByTkdnClassification(string $projectId, string $tkdnClassification): array
    {
        // Ambil HPP items berdasarkan project_id dan tkdn_classification
        $hppItems = HppItem::whereHas('hpp', function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })
            ->where('tkdn_classification', $tkdnClassification)
            ->with(['hpp', 'estimation'])
            ->get();

        return $hppItems->toArray();
    }

    private function generateServiceItemsFromHpp(Service $service, array $hppItems, string $formNumber)
    {
        // Hapus service items yang lama jika ada
        $service->items()->delete();

        foreach ($hppItems as $index => $hppItem) {
            // Buat service item baru berdasarkan data HPP
            ServiceItem::create([
                'service_id' => $service->id,
                'item_number' => $index + 1,
                'description' => $hppItem['description'] ?? 'Item '.($index + 1),
                'qualification' => null, // Bisa diisi sesuai kebutuhan
                'nationality' => 'WNI', // Default WNI, bisa diubah sesuai kebutuhan
                'tkdn_percentage' => $formNumber === '3.1' ? 100 : 0, // Form 3.1 default 100% TKDN
                'quantity' => $hppItem['volume'] ?? 1,
                'duration' => $hppItem['duration'] ?? 1,
                'duration_unit' => $hppItem['duration_unit'] ?? 'ls',
                'wage' => $hppItem['total_price'] ?? 0,
            ]);
        }

        // Recalculate totals
        $service->calculateTotals();
    }
}
