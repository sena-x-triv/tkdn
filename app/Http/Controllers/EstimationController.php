<?php
namespace App\Http\Controllers;

use App\Models\Estimation;
use App\Models\EstimationItem;
use App\Models\Worker;
use App\Models\Material;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EstimationController extends Controller
{
    public function index()
    {
        $estimations = Estimation::withCount('items')->latest()->paginate(10);
        return view('estimation.index', compact('estimations'));
    }

    public function create()
    {
        $workers = Worker::select('id', 'name', 'unit', 'price')->get();
        $materials = Material::select('id', 'name', 'specification', 'unit', 'price')->get();
        $equipment = Equipment::select('id', 'name', 'period', 'price', 'description')->get();
        
        return view('estimation.create', compact('workers', 'materials', 'equipment'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'code' => 'nullable|string|max:255',
                'title' => 'required|string|max:255',
                'total' => 'nullable|integer|min:0',
                'margin' => 'nullable|integer|min:0',
                'total_unit_price' => 'nullable|integer|min:0',
                'items' => 'array',
                'items.*.category' => 'required|in:worker,material,equipment',
                'items.*.reference_id' => 'nullable|ulid',
                'items.*.code' => 'nullable|string|max:255',
                'items.*.coefficient' => 'nullable|numeric',
                'items.*.unit_price' => 'nullable|integer',
                'items.*.total_price' => 'nullable|integer',
            ]);
            $estimation = Estimation::create($data);
            $this->syncEstimationItems($estimation, $data['items'] ?? []);
            return redirect()->route('master.estimation.show', $estimation->id)->with('status', 'AHS & item berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Estimation $estimation)
    {
        $estimation->load('items');
        return view('estimation.show', compact('estimation'));
    }

    public function edit(Estimation $estimation)
    {
        $estimation->load('items');
        $workers = Worker::select('id', 'name', 'unit', 'price')->get();
        $materials = Material::select('id', 'name', 'specification', 'unit', 'price')->get();
        $equipment = Equipment::select('id', 'name', 'period', 'price', 'description')->get();
        
        return view('estimation.edit', compact('estimation', 'workers', 'materials', 'equipment'));
    }

    public function update(Request $request, Estimation $estimation)
    {
        try {
            $data = $request->validate([
                'code' => 'nullable|string|max:255',
                'title' => 'required|string|max:255',
                'total' => 'nullable|integer|min:0',
                'margin' => 'nullable|integer|min:0',
                'total_unit_price' => 'nullable|integer|min:0',
                'items' => 'array',
                'items.*.id' => 'nullable|integer',
                'items.*.category' => 'required|in:worker,material,equipment',
                'items.*.reference_id' => 'nullable|ulid',
                'items.*.code' => 'nullable|string|max:255',
                'items.*.coefficient' => 'nullable|numeric',
                'items.*.unit_price' => 'nullable|integer',
                'items.*.total_price' => 'nullable|integer',
            ]);
            
            $estimation->update($data);
            $this->syncEstimationItems($estimation, $data['items'] ?? []);
            return redirect()->route('master.estimation.show', $estimation->id)->with('status', 'AHS & item berhasil diupdate!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Sync estimation items for update.
     */
    private function syncEstimationItems(Estimation $estimation, array $items)
    {
        $ids = [];
        foreach ($items as $item) {
            // Calculate total_price if not set
            if (!isset($item['total_price']) || $item['total_price'] === null) {
                $item['total_price'] = (float)($item['coefficient'] ?? 0) * (float)($item['unit_price'] ?? 0);
            }
            if (!empty($item['id'])) {
                $estItem = EstimationItem::find($item['id']);
                if ($estItem) {
                    $estItem->update($item);
                    $ids[] = $estItem->id;
                }
            } else {
                $item['estimation_id'] = $estimation->id;
                $newItem = EstimationItem::create($item);
                $ids[] = $newItem->id;
            }
        }
        // Delete removed items
        $estimation->items()->whereNotIn('id', $ids)->delete();
    }

    public function destroy(Estimation $estimation)
    {
        $estimation->delete();
        return redirect()->route('master.estimation.index')->with('status', 'AHS berhasil dihapus!');
    }
} 