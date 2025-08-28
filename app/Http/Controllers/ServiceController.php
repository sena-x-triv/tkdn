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
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-service')->only(['create', 'store', 'edit', 'update', 'destroy', 'generate']);
    }

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
        try {
            $projectId = $request->project_id;

            if (! $projectId) {
                return response()->json(['error' => 'Project ID diperlukan'], 400);
            }

            // Log request for debugging
            Log::info('getHppData request', [
                'project_id' => $projectId,
                'request_data' => $request->all(),
            ]);

            // Validate project exists
            $project = Project::find($projectId);
            if (! $project) {
                Log::warning('Project not found', ['project_id' => $projectId]);

                return response()->json(['error' => 'Project tidak ditemukan'], 404);
            }

            Log::info('Project found', [
                'project_id' => $project->id,
                'project_name' => $project->name,
            ]);

            // Ambil semua HPP untuk project ini dengan error handling
            $hpps = Hpp::where('project_id', $projectId)
                ->with(['items' => function ($query) {
                    $query->orderBy('tkdn_classification')
                        ->orderBy('id');
                }, 'project'])
                ->get();

            Log::info('HPP query result', [
                'project_id' => $projectId,
                'hpp_count' => $hpps->count(),
                'hpp_ids' => $hpps->pluck('id')->toArray(),
            ]);

            if ($hpps->isEmpty()) {
                Log::info('No HPP found for project', ['project_id' => $projectId]);

                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'Tidak ada HPP ditemukan untuk project ini',
                ]);
            }

            $hppData = [];
            foreach ($hpps as $hpp) {
                try {
                    Log::info('Processing HPP', [
                        'hpp_id' => $hpp->id,
                        'hpp_code' => $hpp->code,
                        'items_count' => $hpp->items ? $hpp->items->count() : 0,
                    ]);

                    $hppData[] = [
                        'id' => $hpp->id,
                        'code' => $hpp->code ?? 'N/A',
                        'total_cost' => $hpp->grand_total ?? 0,
                        'items_count' => $hpp->items ? $hpp->items->count() : 0,
                        'project_name' => $hpp->project ? $hpp->project->name : 'N/A',
                        'project_code' => $hpp->project ? $hpp->project->code : 'N/A',
                        'tkdn_breakdown' => $hpp->items ? $hpp->items->groupBy('tkdn_classification')->map(function ($items, $classification) {
                            return [
                                'classification' => $classification,
                                'count' => $items->count(),
                                'total_cost' => $items->sum('total_price'),
                            ];
                        }) : [],
                    ];
                } catch (\Exception $itemError) {
                    Log::warning('Error processing HPP item', [
                        'hpp_id' => $hpp->id,
                        'error' => $itemError->getMessage(),
                        'trace' => $itemError->getTraceAsString(),
                    ]);

                    // Add fallback data for this HPP
                    $hppData[] = [
                        'id' => $hpp->id,
                        'code' => $hpp->code ?? 'N/A',
                        'total_cost' => 0,
                        'items_count' => 0,
                        'project_name' => 'N/A',
                        'project_code' => 'N/A',
                        'tkdn_breakdown' => [],
                        'error' => 'Data tidak dapat diproses',
                    ];
                }
            }

            Log::info('getHppData success', [
                'project_id' => $projectId,
                'data_count' => count($hppData),
            ]);

            return response()->json([
                'success' => true,
                'data' => $hppData,
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getHppData', [
                'project_id' => $request->project_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat mengambil data HPP: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate TKDN forms dari data HPP
     */
    private function generateTkdnFormsFromHpp(Service $service, Hpp $hpp)
    {
        Log::info('Starting TKDN forms generation from HPP', [
            'service_id' => $service->id,
            'hpp_id' => $hpp->id,
            'service_type' => $service->service_type,
            'project_id' => $service->project_id,
        ]);

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

        // Generate Form 3.5 - Rangkuman TKDN Jasa
        $this->createTkdnFormFromHpp($service, $hpp, '3.5', 'Rangkuman TKDN Jasa');

        Log::info('TKDN forms generation from HPP completed', [
            'service_id' => $service->id,
            'total_service_items' => $service->items()->count(),
            'forms_generated' => $service->items()->distinct('tkdn_classification')->count(),
        ]);
    }

    /**
     * Create TKDN form dari data HPP dengan AHS items
     */
    private function createTkdnFormFromHpp(Service $service, Hpp $hpp, string $formNumber, string $formTitle)
    {
        Log::info('Creating TKDN form from HPP', [
            'service_id' => $service->id,
            'hpp_id' => $hpp->id,
            'form_number' => $formNumber,
            'form_title' => $formTitle,
        ]);

        // 1. Ambil HPP items sesuai tkdn_classification
        $hppItems = $hpp->items()->where('tkdn_classification', $formNumber)->get();

        Log::info('HPP items found for form', [
            'form_number' => $formNumber,
            'hpp_items_count' => $hppItems->count(),
            'hpp_items_ids' => $hppItems->pluck('id')->toArray(),
        ]);

        // Jika tidak ada HPP items, buat placeholder item untuk form 3.4 dan 3.5
        if ($hppItems->isEmpty()) {
            Log::info('No HPP items found, creating placeholder', [
                'service_id' => $service->id,
                'form_number' => $formNumber,
            ]);

            if ($formNumber === '3.4') {
                $this->createPlaceholderServiceItems($service, $formNumber, 'Jasa Konsultasi dan Pengawasan');
            } elseif ($formNumber === '3.5') {
                $this->createPlaceholderServiceItems($service, $formNumber, 'Rangkuman TKDN Jasa');
            }

            return;
        }

        $itemNumber = 1;

        foreach ($hppItems as $hppItem) {
            Log::info('Processing HPP item', [
                'hpp_item_id' => $hppItem->id,
                'form_number' => $formNumber,
                'estimation_item_id' => $hppItem->estimation_item_id,
                'description' => $hppItem->description,
                'volume' => $hppItem->volume,
                'duration' => $hppItem->duration,
                'total_price' => $hppItem->total_price,
            ]);

            // 2. Ambil data AHS items berdasarkan HPP item (estimation_item)
            if ($hppItem->estimation_item_id) {
                $estimationItem = $hppItem->estimationItem;
                if ($estimationItem) {
                    // Ambil estimation dari estimation_item
                    $estimation = $estimationItem->estimation;
                    $ahsItems = $estimation->items;

                    Log::info('AHS items found', [
                        'estimation_item_id' => $estimationItem->id,
                        'estimation_id' => $estimation->id ?? 'N/A',
                        'ahs_items_count' => $ahsItems ? $ahsItems->count() : 0,
                    ]);

                    // 3. Insert data AHS items ke table service_items
                    if ($ahsItems && $ahsItems->isNotEmpty()) {
                        foreach ($ahsItems as $ahsItem) {
                            // Tentukan TKDN percentage berdasarkan form dan kategori
                            $tkdnPercentage = $this->calculateTkdnPercentage($formNumber, $ahsItem->category);

                            // Hitung biaya berdasarkan TKDN percentage
                            $totalCost = $ahsItem->total_price;
                            $domesticCost = $totalCost * ($tkdnPercentage / 100);
                            $foreignCost = $totalCost - $domesticCost;

                            Log::info('Creating service item from AHS', [
                                'ahs_item_id' => $ahsItem->id,
                                'category' => $ahsItem->category,
                                'tkdn_percentage' => $tkdnPercentage,
                                'total_cost' => $totalCost,
                                'domestic_cost' => $domesticCost,
                                'foreign_cost' => $foreignCost,
                            ]);

                            ServiceItem::create([
                                'service_id' => $service->id,
                                'estimation_item_id' => $ahsItem->id,
                                'item_number' => $itemNumber++,
                                'tkdn_classification' => $formNumber,
                                'description' => $this->getAhsItemDescription($ahsItem),
                                'qualification' => $this->getAhsItemQualification($ahsItem),
                                'nationality' => 'WNI', // Default WNI
                                'tkdn_percentage' => $tkdnPercentage,
                                'quantity' => $ahsItem->coefficient ?? 1,
                                'duration' => $hppItem->duration,
                                'duration_unit' => $hppItem->duration_unit ?? 'ls',
                                'wage' => $ahsItem->unit_price ?? 0,
                                'domestic_cost' => $domesticCost,
                                'foreign_cost' => $foreignCost,
                                'total_cost' => $totalCost,
                            ]);
                        }
                    } else {
                        // Jika tidak ada AHS items, buat service item dari HPP item langsung
                        Log::info('No AHS items found, creating from HPP item directly', [
                            'hpp_item_id' => $hppItem->id,
                        ]);

                        $tkdnPercentage = $this->calculateTkdnPercentageForForm($formNumber);
                        $totalCost = $hppItem->total_price ?? 0;
                        $domesticCost = $totalCost * ($tkdnPercentage / 100);
                        $foreignCost = $totalCost - $domesticCost;

                        ServiceItem::create([
                            'service_id' => $service->id,
                            'estimation_item_id' => $hppItem->estimation_item_id,
                            'item_number' => $itemNumber++,
                            'tkdn_classification' => $formNumber,
                            'description' => $hppItem->description ?? 'Item '.$itemNumber,
                            'qualification' => $this->getQualificationFromHppItem($hppItem),
                            'nationality' => 'WNI',
                            'tkdn_percentage' => $tkdnPercentage,
                            'quantity' => $hppItem->volume ?? 1,
                            'duration' => $hppItem->duration ?? 1,
                            'duration_unit' => $hppItem->duration_unit ?? 'ls',
                            'wage' => $hppItem->total_price ?? 0,
                            'domestic_cost' => $domesticCost,
                            'foreign_cost' => $foreignCost,
                            'total_cost' => $totalCost,
                        ]);
                    }
                } else {
                    // Jika tidak ada estimation item, buat service item dari HPP item langsung
                    Log::info('No estimation item found, creating from HPP item directly', [
                        'hpp_item_id' => $hppItem->id,
                    ]);

                    $tkdnPercentage = $this->calculateTkdnPercentageForForm($formNumber);
                    $totalCost = $hppItem->total_price ?? 0;
                    $domesticCost = $totalCost * ($tkdnPercentage / 100);
                    $foreignCost = $totalCost - $domesticCost;

                    ServiceItem::create([
                        'service_id' => $service->id,
                        'estimation_item_id' => $hppItem->estimation_item_id,
                        'item_number' => $itemNumber++,
                        'tkdn_classification' => $formNumber,
                        'description' => $hppItem->description ?? 'Item '.$itemNumber,
                        'qualification' => $this->getQualificationFromHppItem($hppItem),
                        'nationality' => 'WNI',
                        'tkdn_percentage' => $tkdnPercentage,
                        'quantity' => $hppItem->volume ?? 1,
                        'duration' => $hppItem->duration ?? 1,
                        'duration_unit' => $hppItem->duration_unit ?? 'ls',
                        'wage' => $hppItem->total_price ?? 0,
                        'domestic_cost' => $domesticCost,
                        'foreign_cost' => $foreignCost,
                        'total_cost' => $totalCost,
                    ]);
                }
            } else {
                // Jika tidak ada estimation_item_id, buat service item dari HPP item langsung
                Log::info('No estimation_item_id, creating from HPP item directly', [
                    'hpp_item_id' => $hppItem->id,
                ]);

                $tkdnPercentage = $this->calculateTkdnPercentageForForm($formNumber);
                $totalCost = $hppItem->total_price ?? 0;
                $domesticCost = $totalCost * ($tkdnPercentage / 100);
                $foreignCost = $totalCost - $domesticCost;

                ServiceItem::create([
                    'service_id' => $service->id,
                    'estimation_item_id' => null,
                    'item_number' => $itemNumber++,
                    'tkdn_classification' => $formNumber,
                    'description' => $hppItem->description ?? 'Item '.$itemNumber,
                    'qualification' => $this->getQualificationFromHppItem($hppItem),
                    'nationality' => 'WNI',
                    'tkdn_percentage' => $tkdnPercentage,
                    'quantity' => $hppItem->volume ?? 1,
                    'duration' => $hppItem->duration ?? 1,
                    'duration_unit' => $hppItem->duration_unit ?? 'ls',
                    'wage' => $hppItem->total_price ?? 0,
                    'domestic_cost' => $domesticCost,
                    'foreign_cost' => $foreignCost,
                    'total_cost' => $totalCost,
                ]);
            }
        }

        // Recalculate totals
        $service->calculateTotals();

        Log::info('TKDN form from HPP created successfully', [
            'service_id' => $service->id,
            'form_number' => $formNumber,
            'service_items_count' => $service->items()->where('tkdn_classification', $formNumber)->count(),
        ]);
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

        // Form 3.4: Jasa Konsultasi - Default 100% TKDN (WNI)
        if ($formNumber === '3.4') {
            return 100.0;
        }

        // Form 3.5: Rangkuman - Default 100% TKDN
        if ($formNumber === '3.5') {
            return 100.0;
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
        try {
            return match ($ahsItem->category) {
                'worker' => $ahsItem->worker?->name ?? $ahsItem->code ?? 'Worker Item',
                'material' => $ahsItem->material?->name ?? $ahsItem->code ?? 'Material Item',
                'equipment' => $ahsItem->equipment?->name ?? $ahsItem->code ?? 'Equipment Item',
                default => $ahsItem->code ?? 'Item',
            };
        } catch (\Exception $e) {
            Log::warning('Error getting AHS item description', [
                'ahs_item_id' => $ahsItem->id,
                'category' => $ahsItem->category,
                'error' => $e->getMessage(),
            ]);

            return $ahsItem->code ?? 'Item';
        }
    }

    /**
     * Generate qualification untuk AHS item
     */
    private function getAhsItemQualification(EstimationItem $ahsItem): ?string
    {
        try {
            return match ($ahsItem->category) {
                'worker' => $ahsItem->worker?->position ?? 'Pekerja',
                'material' => $ahsItem->material?->specification ?? 'Material',
                'equipment' => $ahsItem->equipment?->type ?? 'Equipment',
                default => 'Umum',
            };
        } catch (\Exception $e) {
            Log::warning('Error getting AHS item qualification', [
                'ahs_item_id' => $ahsItem->id,
                'category' => $ahsItem->category,
                'error' => $e->getMessage(),
            ]);

            return 'Umum';
        }
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

                Log::info('Service created successfully with TKDN forms', [
                    'service_id' => $service->id,
                    'hpp_id' => $hpp->id,
                    'service_type' => $service->service_type,
                    'total_service_items' => $service->items()->count(),
                ]);
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

    /**
     * Generate specific TKDN form
     */
    public function generateForm(Service $service, string $formNumber)
    {
        try {
            // Validate form number
            $validForms = ['3.1', '3.2', '3.3', '3.4', '3.5'];
            if (! in_array($formNumber, $validForms)) {
                return back()->with('error', 'Nomor form TKDN tidak valid.');
            }

            DB::transaction(function () use ($service, $formNumber) {
                // Generate specific form
                $this->generateSpecificTkdnForm($service, $formNumber);
            });

            return redirect()->route('service.show', $service)
                ->with('success', "Form {$formNumber} TKDN berhasil dibuat.");
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuat form TKDN: '.$e->getMessage());
        }
    }

    private function generateTkdnForms(Service $service)
    {
        Log::info('Starting TKDN forms generation', [
            'service_id' => $service->id,
            'service_type' => $service->service_type,
            'project_id' => $service->project_id,
        ]);

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

        // Generate Form 3.5 - Rangkuman TKDN Jasa
        $this->createTkdnForm($service, '3.5', 'Rangkuman TKDN Jasa');

        Log::info('TKDN forms generation completed', [
            'service_id' => $service->id,
            'total_service_items' => $service->items()->count(),
            'forms_generated' => $service->items()->distinct('tkdn_classification')->count(),
        ]);
    }

    /**
     * Generate specific TKDN form
     */
    private function generateSpecificTkdnForm(Service $service, string $formNumber)
    {
        $formTitles = [
            '3.1' => 'Jasa Manajemen Proyek dan Perekayasaan',
            '3.2' => 'Jasa Alat Kerja dan Peralatan',
            '3.3' => 'Jasa Konstruksi dan Fabrikasi',
            '3.4' => 'Jasa Konsultasi dan Pengawasan',
            '3.5' => 'Rangkuman TKDN Jasa',
        ];

        $title = $formTitles[$formNumber] ?? 'Jasa TKDN';
        $this->createTkdnForm($service, $formNumber, $title);
    }

    private function createTkdnForm(Service $service, string $formNumber, string $formTitle)
    {
        // Ambil data HPP dengan tkdn_classification yang sesuai
        $hppItems = $this->getHppItemsByTkdnClassification($service->project_id, $formNumber);

        // Log untuk debugging
        Log::info('Creating TKDN form', [
            'service_id' => $service->id,
            'form_number' => $formNumber,
            'form_title' => $formTitle,
            'hpp_items_count' => $hppItems->count(),
            'hpp_items_ids' => $hppItems->pluck('id')->toArray(),
        ]);

        // Generate service items berdasarkan data HPP
        $this->generateServiceItemsFromHpp($service, $hppItems, $formNumber);

        // Update field tkdn_classification setelah generate items
        $service->update([
            'tkdn_classification' => $formNumber,
        ]);

        // Log hasil generation
        Log::info('TKDN form created successfully', [
            'service_id' => $service->id,
            'form_number' => $formNumber,
            'service_items_count' => $service->items()->where('tkdn_classification', $formNumber)->count(),
        ]);
    }

    private function getHppItemsByTkdnClassification(string $projectId, string $tkdnClassification): \Illuminate\Database\Eloquent\Collection
    {
        // Ambil HPP items berdasarkan project_id dan tkdn_classification
        $hppItems = HppItem::whereHas('hpp', function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })
            ->where('tkdn_classification', $tkdnClassification)
            ->with(['hpp', 'estimationItem.estimation.items'])
            ->get();

        return $hppItems;
    }

    private function generateServiceItemsFromHpp(Service $service, \Illuminate\Database\Eloquent\Collection $hppItems, string $formNumber)
    {
        // Hapus service items yang lama untuk form ini
        $service->items()->where('tkdn_classification', $formNumber)->delete();

        // Jika tidak ada HPP items, buat placeholder item untuk form 3.4 dan 3.5
        if ($hppItems->isEmpty()) {
            Log::info('No HPP items found, creating placeholder', [
                'service_id' => $service->id,
                'form_number' => $formNumber,
            ]);

            if ($formNumber === '3.4') {
                $this->createPlaceholderServiceItems($service, $formNumber, 'Jasa Konsultasi dan Pengawasan');
            } elseif ($formNumber === '3.5') {
                $this->createPlaceholderServiceItems($service, $formNumber, 'Rangkuman TKDN Jasa');
            }

            return;
        }

        foreach ($hppItems as $index => $hppItem) {
            // Hitung costs berdasarkan TKDN percentage
            $wage = $hppItem->total_price ?? 0;
            $tkdnPercentage = $this->calculateTkdnPercentageForForm($formNumber);
            $quantity = $hppItem->volume ?? 1;
            $duration = $hppItem->duration ?? 1;

            $totalCost = $wage * $quantity * $duration;
            $domesticCost = ($totalCost * $tkdnPercentage) / 100;
            $foreignCost = $totalCost - $domesticCost;

            // Log data processing untuk debugging
            Log::info('Processing HPP item', [
                'hpp_item_id' => $hppItem->id,
                'form_number' => $formNumber,
                'wage' => $wage,
                'quantity' => $quantity,
                'duration' => $duration,
                'total_cost' => $totalCost,
                'tkdn_percentage' => $tkdnPercentage,
                'domestic_cost' => $domesticCost,
                'foreign_cost' => $foreignCost,
            ]);

            // Buat service item baru berdasarkan data HPP
            ServiceItem::create([
                'service_id' => $service->id,
                'tkdn_classification' => $formNumber,
                'item_number' => $index + 1,
                'description' => $hppItem->description ?? 'Item '.($index + 1),
                'qualification' => $this->getQualificationFromHppItem($hppItem),
                'nationality' => 'WNI', // Default WNI, bisa diubah sesuai kebutuhan
                'tkdn_percentage' => $tkdnPercentage,
                'quantity' => $quantity,
                'duration' => $duration,
                'duration_unit' => $hppItem->duration_unit ?? 'ls',
                'wage' => $wage,
                'domestic_cost' => $domesticCost,
                'foreign_cost' => $foreignCost,
                'total_cost' => $totalCost,
            ]);
        }

        // Recalculate totals
        $service->calculateTotals();
    }

    /**
     * Create placeholder service items for forms that don't have HPP data
     */
    private function createPlaceholderServiceItems(Service $service, string $formNumber, string $formTitle)
    {
        // Buat placeholder item untuk form yang tidak memiliki data HPP
        ServiceItem::create([
            'service_id' => $service->id,
            'tkdn_classification' => $formNumber,
            'item_number' => 1,
            'description' => $formTitle,
            'qualification' => 'Konsultan',
            'nationality' => 'WNI',
            'tkdn_percentage' => $this->calculateTkdnPercentageForForm($formNumber),
            'quantity' => 1,
            'duration' => 1,
            'duration_unit' => 'ls',
            'wage' => 0,
            'domestic_cost' => 0,
            'foreign_cost' => 0,
            'total_cost' => 0,
        ]);

        // Recalculate totals
        $service->calculateTotals();
    }

    /**
     * Calculate TKDN percentage based on form number
     */
    private function calculateTkdnPercentageForForm(string $formNumber): float
    {
        return match ($formNumber) {
            '3.1' => 100.0, // Jasa Manajemen - 100% TKDN
            '3.2' => 0.0,   // Jasa Alat Kerja - 0% TKDN
            '3.3' => 0.0,   // Jasa Konstruksi - 0% TKDN
            '3.4' => 100.0, // Jasa Konsultasi - 100% TKDN (WNI)
            '3.5' => 100.0, // Rangkuman - 100% TKDN
            default => 50.0,
        };
    }

    /**
     * Get qualification from HPP item based on estimation data
     */
    private function getQualificationFromHppItem($hppItem): ?string
    {
        // Jika ada estimation item, coba ambil qualification dari worker
        if ($hppItem->estimationItem && $hppItem->estimationItem->estimation) {
            $estimation = $hppItem->estimationItem->estimation;

            // Cek apakah ada worker data
            if ($estimation->items && $estimation->items->isNotEmpty()) {
                $firstItem = $estimation->items->first();

                // Jika ada worker, ambil qualification
                if ($firstItem->worker) {
                    return $firstItem->worker->qualification ?? 'Pekerja';
                }

                // Jika ada material, ambil kategori
                if ($firstItem->material) {
                    return 'Material: '.$firstItem->material->category ?? 'Umum';
                }

                // Jika ada equipment, ambil kategori
                if ($firstItem->equipment) {
                    return 'Equipment: '.$firstItem->equipment->category ?? 'Umum';
                }
            }
        }

        // Default qualification berdasarkan form type
        return match ($hppItem->tkdn_classification) {
            '3.1' => 'Manajer Proyek',
            '3.2' => 'Operator Alat',
            '3.3' => 'Pekerja Konstruksi',
            '3.4' => 'Konsultan',
            '3.5' => 'Staff',
            default => 'Pekerja',
        };
    }

    /**
     * Export service data to Excel based on TKDN classification
     */
    public function exportExcel(Service $service, string $classification)
    {
        try {
            // Validate classification
            $validClassifications = ['3.1', '3.2', '3.3', '3.4', '3.5', 'all'];
            if (! in_array($classification, $validClassifications)) {
                return back()->with('error', 'Klasifikasi TKDN tidak valid.');
            }

            // Check if service has been generated
            if ($service->status !== 'generated' && $service->status !== 'approved') {
                return back()->with('error', 'Service harus sudah di-generate atau approved untuk dapat di-export.');
            }

            // Use the export service
            $exportService = new \App\Services\ServiceExportService($service, $classification);
            $filepath = $exportService->export();

            // Get filename from path
            $filename = basename($filepath);

            // Verify file exists and is readable
            if (! file_exists($filepath)) {
                throw new \Exception('File Excel tidak ditemukan setelah dibuat.');
            }

            if (! is_readable($filepath)) {
                throw new \Exception('File Excel tidak dapat dibaca.');
            }

            // Check file size
            $fileSize = filesize($filepath);
            if ($fileSize === 0) {
                throw new \Exception('File Excel kosong (0 bytes).');
            }

            if ($fileSize < 1000) {
                throw new \Exception('File Excel terlalu kecil, kemungkinan rusak.');
            }

            // Verify file extension
            $fileExtension = pathinfo($filepath, PATHINFO_EXTENSION);
            if ($fileExtension !== 'xlsx') {
                throw new \Exception('File yang dihasilkan bukan file Excel (.xlsx): '.$fileExtension);
            }

            // Verify file content (basic Excel file signature check)
            $fileContent = file_get_contents($filepath, false, null, 0, 4);
            if ($fileContent !== 'PK'.chr(0x03).chr(0x04)) {
                throw new \Exception('File Excel tidak memiliki signature yang valid');
            }

            // Return file download response
            return response()->download($filepath, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
                'Cache-Control' => 'no-cache, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Excel export failed', [
                'service_id' => $service->id,
                'classification' => $classification,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat export Excel: '.$e->getMessage());
        }
    }
}
