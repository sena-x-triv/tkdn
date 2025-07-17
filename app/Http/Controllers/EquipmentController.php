<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::latest()->paginate(10);
        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tkdn' => 'nullable|numeric|min:0|max:100',
            'period' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);
        Equipment::create($data);
        return redirect()->route('master.equipment.index')->with('status', 'Peralatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tkdn' => 'nullable|numeric|min:0|max:100',
            'period' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);
        $equipment->update($data);
        return redirect()->route('master.equipment.index')->with('status', 'Peralatan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('master.equipment.index')->with('status', 'Peralatan berhasil dihapus!');
    }
}
 