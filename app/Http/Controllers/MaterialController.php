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
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required|exists:categories,id',
                'brand' => 'nullable|string',
                'specification' => 'nullable|string',
                'tkdn' => 'nullable|integer|min:0|max:100',
                'price' => 'required|integer',
                'unit' => 'required',
                'link' => 'nullable|url',
                'price_inflasi' => 'nullable|integer|min:0',
                'description' => 'nullable|string',
                'location' => 'nullable|string'
            ]);

            // Generate code otomatis
            $code = $this->codeGenerationService->generateCode('material');
            
            $data = $request->all();
            $data['code'] = $code;
            
            Material::create($data);
            return redirect()->route('master.material.index')->with('success', 'Material created successfully with code: ' . $code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while creating material: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Material $material) {
        return view('material.show', compact('material'));
    }

    public function edit(Material $material) {
        $categories = Category::orderBy('name')->get();
        return view('material.edit', compact('material', 'categories'));
    }

    public function update(Request $request, Material $material) {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required|exists:categories,id',
                'brand' => 'nullable|string',
                'specification' => 'nullable|string',
                'tkdn' => 'nullable|integer|min:0|max:100',
                'price' => 'required|integer',
                'unit' => 'required',
                'link' => 'nullable|url',
                'price_inflasi' => 'nullable|integer|min:0',
                'description' => 'nullable|string',
                'location' => 'nullable|string'
            ]);
            
            $material->update($request->all());
            return redirect()->route('master.material.index')->with('success', 'Material updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating material: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Material $material) {
        try {
            $material->delete();
            return redirect()->route('master.material.index')->with('success', 'Material deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while deleting material: ' . $e->getMessage()]);
        }
    }
} 