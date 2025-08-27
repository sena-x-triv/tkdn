<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use App\Contracts\CodeGenerationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $equipment = Equipment::with('category')->latest()->paginate(10);

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

            return redirect()->route('master.equipment.index')->with('success', 'Peralatan berhasil ditambahkan dengan code: '.$code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan peralatan: '.$e->getMessage()])->withInput();
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
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate peralatan: '.$e->getMessage()])->withInput();
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
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus peralatan: '.$e->getMessage()]);
        }
    }

    /**
     * Download Excel template for equipment import
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['Name', 'Category', 'TKDN', 'Equipment Type', 'Period (Days)', 'Price', 'Description', 'Location'];
        $sheet->fromArray($headers, null, 'A1');

        // Set example data
        $exampleData = [
            ['Excavator Mini', 'Heavy Equipment', '85.50', 'reusable', '30', '2500000', 'Mini excavator for small projects', 'Jakarta'],
            ['Safety Helmet', 'Safety Equipment', '100.00', 'disposable', '0', '150000', 'Safety helmet for workers', 'Bandung'],
        ];
        $sheet->fromArray($exampleData, null, 'A2');

        // Style headers
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E5E7EB');

        // Auto size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create response
        $writer = new Xlsx($spreadsheet);
        $filename = 'equipment_import_template.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Import equipment from Excel file
     */
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row
            $headers = array_shift($rows);

            $imported = 0;
            $errors = [];
            $rowNumber = 2; // Start from row 2 (after header)

            foreach ($rows as $row) {
                if (empty(array_filter($row))) {
                    $rowNumber++;

                    continue; // Skip empty rows
                }

                // Validate required fields
                if (empty($row[0]) || empty($row[3]) || empty($row[4]) || empty($row[5])) {
                    $errors[] = "Row {$rowNumber}: Missing required fields (Name, Equipment Type, Period, or Price)";
                    $rowNumber++;

                    continue;
                }

                // Validate equipment type
                if (! in_array($row[3], ['disposable', 'reusable'])) {
                    $errors[] = "Row {$rowNumber}: Equipment Type must be 'disposable' or 'reusable'";
                    $rowNumber++;

                    continue;
                }

                // Validate TKDN range
                if (! empty($row[2]) && (! is_numeric($row[2]) || $row[2] < 0 || $row[2] > 100)) {
                    $errors[] = "Row {$rowNumber}: TKDN must be a number between 0-100";
                    $rowNumber++;

                    continue;
                }

                // Validate Period
                if (! is_numeric($row[4]) || $row[4] < 0) {
                    $errors[] = "Row {$rowNumber}: Period must be a positive number";
                    $rowNumber++;

                    continue;
                }

                // Validate Period for equipment type
                if ($row[3] === 'disposable' && $row[4] != 0) {
                    $errors[] = "Row {$rowNumber}: Period must be 0 for disposable equipment";
                    $rowNumber++;

                    continue;
                }

                if ($row[3] === 'reusable' && $row[4] < 1) {
                    $errors[] = "Row {$rowNumber}: Period must be at least 1 for reusable equipment";
                    $rowNumber++;

                    continue;
                }

                // Validate Price
                if (! is_numeric($row[5]) || $row[5] < 0) {
                    $errors[] = "Row {$rowNumber}: Price must be a positive number";
                    $rowNumber++;

                    continue;
                }

                try {
                    // Find category by name if provided
                    $categoryId = null;
                    if (! empty($row[1])) {
                        $category = Category::where('name', 'LIKE', '%'.trim($row[1]).'%')->first();
                        if ($category) {
                            $categoryId = $category->id;
                        }
                    }

                    // Generate code
                    $code = $this->codeGenerationService->generateCode('equipment');

                    // Create equipment
                    Equipment::create([
                        'name' => trim($row[0]),
                        'category_id' => $categoryId,
                        'tkdn' => ! empty($row[2]) ? (float) $row[2] : null,
                        'period' => (int) $row[4],
                        'price' => (int) $row[5],
                        'description' => ! empty($row[6]) ? trim($row[6]) : null,
                        'location' => ! empty($row[7]) ? trim($row[7]) : null,
                        'code' => $code,
                    ]);

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Row {$rowNumber}: ".$e->getMessage();
                }

                $rowNumber++;
            }

            DB::commit();

            if (empty($errors)) {
                return redirect()->route('master.equipment.index')
                    ->with('success', "Successfully imported {$imported} equipment!");
            } else {
                return redirect()->route('master.equipment.index')
                    ->with('success', "Successfully imported {$imported} equipment!")
                    ->with('import_errors', $errors);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('master.equipment.index')
                ->with('error', 'Import failed: '.$e->getMessage());
        }
    }
}
 