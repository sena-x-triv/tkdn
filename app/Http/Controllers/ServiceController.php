<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['project', 'items'])
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
} 