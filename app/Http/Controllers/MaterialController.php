<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Contracts\CodeGenerationServiceInterface;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    protected $codeGenerationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CodeGenerationServiceInterface $codeGenerationService)
    {
        $this->middleware('auth');
        $this->codeGenerationService = $codeGenerationService;
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
        $categories = Category::orderBy('name')->get();
        return view('material.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required',
            'price' => 'required|integer',
            'unit' => 'required',
            'location' => 'nullable|string'
        ]);

        // Generate code otomatis
        $code = $this->codeGenerationService->generateCode('material');
        
        $data = $request->all();
        $data['code'] = $code;
        
        Material::create($data);
        return redirect()->route('master.material.index')->with('success', 'Material created with code: ' . $code);
    }

    public function show(Material $material) {
        return view('material.show', compact('material'));
    }

    public function edit(Material $material) {
        $categories = Category::orderBy('name')->get();
        return view('material.edit', compact('material', 'categories'));
    }

    public function update(Request $request, Material $material) {
        $request->validate([
            'code' => 'required|unique:material,code,' . $material->id . ',id',
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required',
            'price' => 'required|integer',
            'unit' => 'required',
            'location' => 'nullable|string'
        ]);
        $material->update($request->all());
        return redirect()->route('master.material.index')->with('success', 'Material updated!');
    }

    public function destroy(Material $material) {
        $material->delete();
        return redirect()->route('master.material.index')->with('success', 'Material deleted!');
    }
} 