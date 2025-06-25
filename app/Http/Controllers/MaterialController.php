<?php
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $materials = Material::paginate(10);
        return view('material.index', compact('materials'));
    }

    public function create() {
        return view('material.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'price' => 'required|integer',
            'unit' => 'required'
        ]);
        Material::create($request->all());
        return redirect()->route('material.index')->with('success', 'Material created!');
    }

    public function edit(Material $material) {
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, Material $material) {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'price' => 'required|integer',
            'unit' => 'required'
        ]);
        $material->update($request->all());
        return redirect()->route('material.index')->with('success', 'Material updated!');
    }

    public function destroy(Material $material) {
        $material->delete();
        return redirect()->route('material.index')->with('success', 'Material deleted!');
    }
} 