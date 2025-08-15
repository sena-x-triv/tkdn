<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use App\Contracts\CodeGenerationServiceInterface;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    protected $codeGenerationService;

    /**
     * Create a new controller instance.
     */
    public function __construct(CodeGenerationServiceInterface $codeGenerationService)
    {
        $this->middleware('auth');
        $this->codeGenerationService = $codeGenerationService;
    }

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
        $categories = Category::orderBy('name')->get();
        return view('equipment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'tkdn' => 'nullable|numeric|min:0|max:100',
                'equipment_type' => 'required|in:disposable,reusable',
                'period' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                'description' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
            ]);

            // Validasi period berdasarkan jenis equipment
            if ($data['equipment_type'] === 'disposable') {
                $data['period'] = 0; // Force period to 0 for disposable items
            } else {
                // Untuk reusable equipment, period minimal 1
                $request->validate([
                    'period' => 'required|integer|min:1',
                ]);
            }

            // Generate code otomatis
            $code = $this->codeGenerationService->generateCode('equipment');
            
            $data['code'] = $code;
            
            // Remove equipment_type from data as it's not stored in database
            unset($data['equipment_type']);
            
            Equipment::create($data);
            return redirect()->route('master.equipment.index')->with('success', 'Peralatan berhasil ditambahkan dengan code: ' . $code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan peralatan: ' . $e->getMessage()])->withInput();
        }
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
        $categories = Category::orderBy('name')->get();
        return view('equipment.edit', compact('equipment', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'tkdn' => 'nullable|numeric|min:0|max:100',
                'equipment_type' => 'required|in:disposable,reusable',
                'period' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                'description' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
            ]);

            // Validasi period berdasarkan jenis equipment
            if ($data['equipment_type'] === 'disposable') {
                $data['period'] = 0; // Force period to 0 for disposable items
            } else {
                // Untuk reusable equipment, period minimal 1
                $request->validate([
                    'period' => 'required|integer|min:1',
                ]);
            }

            // Remove equipment_type from data as it's not stored in database
            unset($data['equipment_type']);
            
            $equipment->update($data);
            return redirect()->route('master.equipment.index')->with('success', 'Peralatan berhasil diupdate!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate peralatan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        try {
            $equipment->delete();
            return redirect()->route('master.equipment.index')->with('success', 'Peralatan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus peralatan: ' . $e->getMessage()]);
        }
    }
}
 