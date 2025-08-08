<?php

namespace App\Http\Controllers;

use App\Models\Hpp;
use App\Models\HppItem;
use App\Models\Estimation;
use App\Models\EstimationItem;
use App\Models\Worker;
use App\Models\Material;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hpps = Hpp::with('items')->latest()->paginate(10);
        return view('hpp.index', compact('hpps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estimations = Estimation::with('items')->get();
        $ahsData = $this->getAhsData();
        return view('hpp.create', compact('estimations', 'ahsData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'work_description' => 'required|string',
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
            $code = 'HPP-' . date('Ymd') . '-' . strtoupper(Str::random(4));

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
                'title' => $request->title,
                'company_name' => $request->company_name,
                'work_description' => $request->work_description,
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
                    'item_number' => $item['item_number'] ?? ($index + 1),
                    'description' => $item['description'],
                    'tkdn_classification' => $item['tkdn_classification'],
                    'volume' => $item['volume'],
                    'unit' => $item['unit'],
                    'duration' => $item['duration'],
                    'duration_unit' => $item['duration_unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['volume'] * $item['unit_price'],
                    'estimation_item_id' => $item['estimation_item_id'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('hpp.index')->with('success', 'HPP berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hpp = Hpp::with('items')->findOrFail($id);
        return view('hpp.show', compact('hpp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hpp = Hpp::with('items')->findOrFail($id);
        $estimations = Estimation::with('items')->get();
        $ahsData = $this->getAhsData();
        return view('hpp.edit', compact('hpp', 'estimations', 'ahsData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'work_description' => 'required|string',
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
                'title' => $request->title,
                'company_name' => $request->company_name,
                'work_description' => $request->work_description,
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
                    'item_number' => $item['item_number'] ?? ($index + 1),
                    'description' => $item['description'],
                    'tkdn_classification' => $item['tkdn_classification'],
                    'volume' => $item['volume'],
                    'unit' => $item['unit'],
                    'duration' => $item['duration'],
                    'duration_unit' => $item['duration_unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['volume'] * $item['unit_price'],
                    'estimation_item_id' => $item['estimation_item_id'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('hpp.index')->with('success', 'HPP berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $hpp = Hpp::findOrFail($id);
            $hpp->delete();
            return redirect()->route('hpp.index')->with('success', 'HPP berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get estimation items for AJAX request
     */
    public function getEstimationItems(Request $request)
    {
        $estimationId = $request->estimation_id;
        $estimation = Estimation::with('items')->find($estimationId);
        
        if (!$estimation) {
            return response()->json(['error' => 'Estimation tidak ditemukan'], 404);
        }

        $items = $estimation->items->map(function ($item) {
            return [
                'id' => $item->id,
                'description' => $item->code . ' - ' . $item->equipment_name,
                'unit_price' => $item->unit_price,
                'coefficient' => $item->coefficient,
            ];
        });

        return response()->json($items);
    }

    /**
     * Get AHS data for dropdown
     */
    private function getAhsData()
    {
        $ahsData = [];

        // Get Estimations (AHS)
        $estimations = Estimation::with('items')->get();
        foreach ($estimations as $estimation) {
            $ahsData[] = [
                'type' => 'ahs',
                'id' => $estimation->id,
                'code' => $estimation->code,
                'title' => $estimation->title,
                'description' => $estimation->code . ' - ' . $estimation->title,
                'unit_price' => $estimation->total_unit_price,
                'category' => 'AHS',
                'items' => $estimation->items->map(function ($item) {
                    $itemName = '';
                    if ($item->category === 'worker' && $item->worker) {
                        $itemName = $item->worker->name;
                    } elseif ($item->category === 'material' && $item->material) {
                        $itemName = $item->material->name;
                    } elseif ($item->category === 'equipment' && $item->equipment) {
                        $itemName = $item->equipment->name;
                    }
                    
                    return [
                        'id' => $item->id,
                        'category' => $item->category,
                        'code' => $item->code,
                        'name' => $itemName,
                        'coefficient' => $item->coefficient,
                        'unit_price' => $item->unit_price,
                        'total_price' => $item->total_price,
                    ];
                })
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
                'description' => $worker->code . ' - ' . $worker->name,
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
                'description' => $material->code . ' - ' . $material->name,
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
                'description' => $eq->code . ' - ' . $eq->name,
                'unit_price' => $eq->price,
                'category' => 'Peralatan',
                'period' => $eq->period,
                'tkdn' => $eq->tkdn,
            ];
        }

        return $ahsData;
    }

    /**
     * Get AHS data for AJAX request
     */
    public function getAhsDataAjax(Request $request)
    {
        $ahsData = $this->getAhsData();
        return response()->json($ahsData);
    }
}
