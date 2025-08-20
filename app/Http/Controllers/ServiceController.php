<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
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
            DB::transaction(function () use ($validated) {
                $service = Service::create([
                    'project_id' => $validated['project_id'],
                    'service_name' => $validated['service_name'],
                    'service_type' => $validated['service_type'],
                    'provider_name' => $validated['provider_name'],
                    'provider_address' => $validated['provider_address'],
                    'user_name' => $validated['user_name'],
                    'document_number' => $validated['document_number'],
                ]);

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
                ->with('success', 'Jasa berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan jasa.');
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

        // Generate Form 3.5 - Jasa Lainnya
        $this->createTkdnForm($service, '3.5', 'Jasa Lainnya');
    }

    private function createTkdnForm(Service $service, string $formNumber, string $formTitle)
    {
        // Ambil data HPP dengan tkdn_classification yang sesuai
        $hppItems = $this->getHppItemsByTkdnClassification($service->project_id, $formNumber);

        // Buat record form TKDN (bisa disimpan di tabel baru atau menggunakan field existing)
        // Untuk sementara, kita akan menggunakan field tkdn_classification yang sudah ada
        try {
            $service->update([
                'tkdn_classification' => "Form {$formNumber}: {$formTitle}",
            ]);

            // Generate service items berdasarkan data HPP
            $this->generateServiceItemsFromHpp($service, $hppItems, $formNumber);

        } catch (\Exception $e) {
            // Jika field tkdn_classification tidak ada, skip update field tersebut
            // tapi tetap update status
        }
    }

    private function getHppItemsByTkdnClassification(string $projectId, string $tkdnClassification): array
    {
        // Ambil HPP items berdasarkan project_id dan tkdn_classification
        $hppItems = HppItem::whereHas('hpp', function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })
            ->where('tkdn_classification', $tkdnClassification)
            ->with(['hpp', 'estimationItem'])
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
