<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Estimation;
use App\Models\EstimationItem;
use App\Models\Hpp;
use App\Models\Material;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-hpp')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hpps = Hpp::with(['items', 'project'])->latest()->paginate(10);

        return view('hpp.index', compact('hpps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $ahsData = $this->getAhsData();

        return view('hpp.create', compact('projects', 'ahsData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'overhead_percentage' => 'required|numeric|min:0|max:100',
            'margin_percentage' => 'required|numeric|min:0|max:100',
            'ppn_percentage' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.tkdn_classification' => 'required|string',
            'items.*.volume' => 'required|numeric|min:0',
            'items.*.unit' => 'required|string',
            'items.*.duration' => 'required|integer|min:1',
            'items.*.duration_unit' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Generate kode HPP
            $code = 'HPP-'.date('Ymd').'-'.strtoupper(Str::random(4));

            // Hitung total HPP
            $subTotalHpp = 0;
            foreach ($request->items as $item) {
                $subTotalHpp += $item['volume'] * $item['unit_price'];
            }

            // Hitung overhead
            $overheadAmount = $subTotalHpp * ($request->overhead_percentage / 100);

            // Hitung margin
            $marginAmount = $subTotalHpp * ($request->margin_percentage / 100);

            // Hitung sub total
            $subTotal = $subTotalHpp + $overheadAmount + $marginAmount;

            // Hitung PPN
            $ppnAmount = $subTotal * ($request->ppn_percentage / 100);

            // Hitung grand total
            $grandTotal = $subTotal + $ppnAmount;

            // Buat HPP
            $hpp = Hpp::create([
                'code' => $code,
                'project_id' => $request->project_id,
                'sub_total_hpp' => $subTotalHpp,
                'overhead_percentage' => $request->overhead_percentage,
                'overhead_amount' => $overheadAmount,
                'margin_percentage' => $request->margin_percentage,
                'margin_amount' => $marginAmount,
                'sub_total' => $subTotal,
                'ppn_percentage' => $request->ppn_percentage,
                'ppn_amount' => $ppnAmount,
                'grand_total' => $grandTotal,
                'notes' => $request->notes,
                'status' => 'draft',
            ]);

            // Buat HPP items
            foreach ($request->items as $index => $item) {
                $hpp->items()->create([
                    'estimation_item_id' => $item['estimation_item_id'] ?? null,
                    'description' => $item['description'],
                    'tkdn_classification' => $item['tkdn_classification'],
                    'volume' => $item['volume'],
                    'unit' => $item['unit'],
                    'duration' => $item['duration'],
                    'duration_unit' => $item['duration_unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['volume'] * $item['unit_price'],
                ]);
            }

            DB::commit();

            return redirect()->route('hpp.index')->with('success', 'HPP berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hpp = Hpp::with(['items', 'project'])->findOrFail($id);

        return view('hpp.show', compact('hpp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hpp = Hpp::with(['items', 'project'])->findOrFail($id);
        $projects = Project::all();
        $ahsData = $this->getAhsData();

        return view('hpp.edit', compact('hpp', 'projects', 'ahsData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'overhead_percentage' => 'required|numeric|min:0|max:100',
            'margin_percentage' => 'required|numeric|min:0|max:100',
            'ppn_percentage' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.tkdn_classification' => 'required|string',
            'items.*.volume' => 'required|numeric|min:0',
            'items.*.unit' => 'required|string',
            'items.*.duration' => 'required|integer|min:1',
            'items.*.duration_unit' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $hpp = Hpp::findOrFail($id);

            // Hitung total HPP
            $subTotalHpp = 0;
            foreach ($request->items as $item) {
                $subTotalHpp += $item['volume'] * $item['unit_price'];
            }

            // Hitung overhead
            $overheadAmount = $subTotalHpp * ($request->overhead_percentage / 100);

            // Hitung margin
            $marginAmount = $subTotalHpp * ($request->margin_percentage / 100);

            // Hitung sub total
            $subTotal = $subTotalHpp + $overheadAmount + $marginAmount;

            // Hitung PPN
            $ppnAmount = $subTotal * ($request->ppn_percentage / 100);

            // Hitung grand total
            $grandTotal = $subTotal + $ppnAmount;

            // Update HPP
            $hpp->update([
                'project_id' => $request->project_id,
                'sub_total_hpp' => $subTotalHpp,
                'overhead_percentage' => $request->overhead_percentage,
                'overhead_amount' => $overheadAmount,
                'margin_percentage' => $request->margin_percentage,
                'margin_amount' => $marginAmount,
                'sub_total' => $subTotal,
                'ppn_percentage' => $request->ppn_percentage,
                'ppn_amount' => $ppnAmount,
                'grand_total' => $grandTotal,
                'notes' => $request->notes,
            ]);

            // Hapus items lama
            $hpp->items()->delete();

            // Buat HPP items baru
            foreach ($request->items as $index => $item) {
                $hpp->items()->create([
                    'estimation_item_id' => $item['estimation_item_id'] ?? null,
                    'description' => $item['description'],
                    'tkdn_classification' => $item['tkdn_classification'],
                    'volume' => $item['volume'],
                    'unit' => $item['unit'],
                    'duration' => $item['duration'],
                    'duration_unit' => $item['duration_unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['volume'] * $item['unit_price'],
                ]);
            }

            DB::commit();

            return redirect()->route('hpp.index')->with('success', 'HPP berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $hpp = Hpp::findOrFail($id);
            $hpp->items()->delete();
            $hpp->delete();

            return redirect()->route('hpp.index')->with('success', 'HPP berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Get estimation items for AJAX request
     */
    public function getEstimationItems(Request $request, string $id)
    {
        $hpp = Hpp::with(['items'])->findOrFail($id);
        $items = $hpp->items;

        return response()->json($items);
    }

    /**
     * Get AHS data for dropdown
     */
    public function getAhsData()
    {
        $ahsData = [];

        // Get Estimations (AHS) only
        $estimations = Estimation::with('items')->get();
        foreach ($estimations as $estimation) {
            $ahsData[] = [
                'type' => 'ahs',
                'id' => $estimation->id,
                'code' => $estimation->code,
                'title' => $estimation->title,
                'description' => $estimation->code.' - '.$estimation->title,
                'category' => 'AHS',
                'item_count' => $estimation->items->count(),
            ];
        }

        // Get Workers
        $workers = Worker::with('category')->get();
        foreach ($workers as $worker) {
            $ahsData[] = [
                'type' => 'worker',
                'id' => $worker->id,
                'code' => $worker->code,
                'title' => $worker->name,
                'description' => $worker->code.' - '.$worker->name,
                'unit_price' => $worker->price,
                'category' => 'Pekerja',
                'unit' => $worker->unit,
                'tkdn' => $worker->tkdn,
            ];
        }

        // Get Materials
        $materials = Material::with('category')->get();
        foreach ($materials as $material) {
            $ahsData[] = [
                'type' => 'material',
                'id' => $material->id,
                'code' => $material->code,
                'title' => $material->name,
                'description' => $material->code.' - '.$material->name,
                'unit_price' => $material->price,
                'category' => 'Material',
                'unit' => $material->unit,
                'tkdn' => $material->tkdn,
            ];
        }

        // Get Equipment
        $equipment = Equipment::with('category')->get();
        foreach ($equipment as $eq) {
            $ahsData[] = [
                'type' => 'equipment',
                'id' => $eq->id,
                'code' => $eq->code,
                'title' => $eq->name,
                'description' => $eq->code.' - '.$eq->name,
                'unit_price' => $eq->price,
                'category' => 'Peralatan',
                'period' => $eq->period,
                'tkdn' => $eq->tkdn,
            ];
        }

        return $ahsData;
    }

    /**
     * Get item name based on category
     */
    private function getItemName(EstimationItem $item): string
    {
        switch ($item->category) {
            case 'worker':
                return $item->worker ? $item->worker->name : 'Pekerja';
            case 'material':
                return $item->material ? $item->material->name : 'Material';
            case 'equipment':
                return $item->equipment ? $item->equipment->name : 'Peralatan';
            default:
                return 'Item';
        }
    }

    /**
     * Get item unit based on category
     */
    private function getItemUnit(EstimationItem $item): string
    {
        switch ($item->category) {
            case 'worker':
                return 'OH';
            case 'material':
                return 'Unit';
            case 'equipment':
                return 'Hari';
            default:
                return 'Unit';
        }
    }

    /**
     * Get AHS data for AJAX request
     */
    public function getAhsDataAjax(Request $request)
    {
        $ahsData = $this->getAhsData();

        return response()->json($ahsData);
    }

    /**
     * Get AHS items for AJAX request
     */
    public function getAhsItems(Request $request)
    {
        $estimationId = $request->estimation_id;
        $estimation = Estimation::with('items')->find($estimationId);

        if (! $estimation) {
            return response()->json(['error' => 'Estimation tidak ditemukan'], 404);
        }

        $items = $estimation->items->map(function ($item) {
            return [
                'id' => $item->id,
                'description' => $this->getItemName($item),
                'code' => $item->code,
                'category' => $item->category,
                'unit_price' => $item->unit_price,
                'coefficient' => $item->coefficient,
                'tkdn_classification' => $item->tkdn_classification,
                'tkdn_value' => $item->tkdn_value,
                'unit' => $this->getItemUnit($item),
            ];
        });

        return response()->json([
            'estimation' => [
                'id' => $estimation->id,
                'code' => $estimation->code,
                'title' => $estimation->title,
            ],
            'items' => $items,
        ]);
    }
}
