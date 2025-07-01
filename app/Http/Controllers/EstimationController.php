<?php
namespace App\Http\Controllers;

use App\Models\Estimation;
use App\Models\Worker;
use App\Models\Material;
use Illuminate\Http\Request;

class EstimationController extends Controller
{
    public function index()
    {
        $estimations = Estimation::with(['worker', 'material'])->get();
        return view('estimation.index', compact('estimations'));
    }

    public function create()
    {
        $workers = Worker::all();
        $materials = Material::all();
        return view('estimation.create', compact('workers', 'materials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|in:worker,material,equipment',
            'reference_id' => 'nullable|ulid',
            'equipment_name' => 'nullable|string|max:255',
            'unit' => 'required|string|max:50',
            'coefficient' => 'required|numeric|min:0',
            'unit_price' => 'required|integer|min:0',
        ]);
        $data['total_price'] = $data['coefficient'] * $data['unit_price'];
        Estimation::create($data);
        return redirect()->route('estimation.index')->with('status', 'Estimation added!');
    }

    public function edit(Estimation $estimation)
    {
        $workers = \App\Models\Worker::all();
        $materials = \App\Models\Material::all();
        return view('estimation.edit', compact('estimation', 'workers', 'materials'));
    }

    public function update(Request $request, Estimation $estimation)
    {
        $data = $request->validate([
            'category' => 'required|in:worker,material,equipment',
            'reference_id' => 'nullable|ulid',
            'equipment_name' => 'nullable|string|max:255',
            'unit' => 'required|string|max:50',
            'coefficient' => 'required|numeric|min:0',
            'unit_price' => 'required|integer|min:0',
        ]);
        $data['total_price'] = $data['coefficient'] * $data['unit_price'];
        $estimation->update($data);
        return redirect()->route('estimation.index')->with('status', 'Estimation updated!');
    }

    public function destroy(Estimation $estimation)
    {
        $estimation->delete();
        return redirect()->route('estimation.index')->with('status', 'Estimation deleted!');
    }
} 