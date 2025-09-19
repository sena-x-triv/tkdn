<?php

namespace App\Http\Controllers;

use App\Contracts\CodeGenerationServiceInterface;
use App\Models\Category;
use App\Models\Material;
use App\Services\ImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MaterialController extends Controller
{
    protected $codeGenerationService;

    protected $importService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CodeGenerationServiceInterface $codeGenerationService, ImportService $importService)
    {
        $this->middleware('auth');
        $this->codeGenerationService = $codeGenerationService;
        $this->importService = $importService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $materials = Material::with('category')->paginate(10);

        return view('material.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('material.create', compact('categories'));
    }

    public function store(Request $request)
    {
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
                'location' => 'nullable|string',
            ]);

            // Generate code otomatis
            $code = $this->codeGenerationService->generateCode('material');

            $data = $request->all();
            $data['code'] = $code;

            Material::create($data);

            return redirect()->route('master.material.index')->with('success', 'Material created successfully with code: '.$code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while creating material: '.$e->getMessage()])->withInput();
        }
    }

    public function show(Material $material)
    {
        return view('material.show', compact('material'));
    }

    public function edit(Material $material)
    {
        $categories = Category::orderBy('name')->get();

        return view('material.edit', compact('material', 'categories'));
    }

    public function update(Request $request, Material $material)
    {
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
                'location' => 'nullable|string',
            ]);

            $material->update($request->all());

            return redirect()->route('master.material.index')->with('success', 'Material updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating material: '.$e->getMessage()])->withInput();
        }
    }

    public function destroy(Material $material)
    {
        try {
            $material->delete();

            return redirect()->route('master.material.index')->with('success', 'Material deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while deleting material: '.$e->getMessage()]);
        }
    }

    /**
     * Download Excel template for material import
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['Name', 'Category', 'Brand', 'Specification', 'TKDN', 'Price', 'Unit', 'Link', 'Price Inflasi', 'Description', 'Location', 'Classification TKDN'];
        $sheet->fromArray($headers, null, 'A1');

        // Set example data
        $exampleData = [
            ['Cement Portland', 'Building Material', 'Semen Gresik', 'Type I', '100', '85000', 'Sak', 'https://example.com', '90000', 'Portland cement type I', 'Jakarta', '1.2'],
            ['Steel Bar', 'Steel', 'Krakatau Steel', 'Diameter 10mm', '85', '150000', 'Ton', 'https://example.com', '160000', 'Steel reinforcement bar', 'Bandung', '2.1'],
        ];
        $sheet->fromArray($exampleData, null, 'A2');

        // Style headers
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E5E7EB');

        // Auto size columns
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create response
        $writer = new Xlsx($spreadsheet);
        $filename = 'material_import_template.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Import materials from Excel file
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

            // Clear cache untuk memastikan data fresh
            $this->importService->clearCache();

            foreach ($rows as $row) {
                if (empty(array_filter($row))) {
                    $rowNumber++;

                    continue; // Skip empty rows
                }

                // Validasi field required
                $requiredErrors = $this->importService->validateRequiredFields(
                    $row,
                    [0 => 'Name', 5 => 'Price', 6 => 'Unit'],
                    $rowNumber
                );

                if (! empty($requiredErrors)) {
                    $errors = array_merge($errors, $requiredErrors);
                    $rowNumber++;

                    continue;
                }

                // Validasi dan cari kategori berdasarkan nama
                [$categoryId, $categoryErrors] = $this->importService->validateAndGetCategoryId(
                    $row[1] ?? null,
                    $rowNumber
                );

                if (! empty($categoryErrors)) {
                    $errors = array_merge($errors, $categoryErrors);
                    $rowNumber++;

                    continue;
                }

                // Validasi TKDN range
                $tkdnErrors = $this->importService->validateNumericRange(
                    $row[4] ?? null,
                    'TKDN',
                    $rowNumber,
                    0,
                    100
                );

                if (! empty($tkdnErrors)) {
                    $errors = array_merge($errors, $tkdnErrors);
                    $rowNumber++;

                    continue;
                }

                // Validasi Price
                $priceErrors = $this->importService->validateNumericRange(
                    $row[5],
                    'Price',
                    $rowNumber,
                    0
                );

                if (! empty($priceErrors)) {
                    $errors = array_merge($errors, $priceErrors);
                    $rowNumber++;

                    continue;
                }

                // Validasi Price Inflasi
                $priceInflasiErrors = $this->importService->validateNumericRange(
                    $row[8] ?? null,
                    'Price Inflasi',
                    $rowNumber,
                    0
                );

                if (! empty($priceInflasiErrors)) {
                    $errors = array_merge($errors, $priceInflasiErrors);
                    $rowNumber++;

                    continue;
                }

                // Validasi Classification TKDN
                $classificationErrors = $this->importService->validateClassificationTkdn(
                    $row[11] ?? null,
                    $rowNumber
                );

                if (! empty($classificationErrors)) {
                    $errors = array_merge($errors, $classificationErrors);
                    $rowNumber++;

                    continue;
                }

                try {
                    // Generate code
                    $code = $this->codeGenerationService->generateCode('material');

                    // Create material
                    Material::create([
                        'name' => trim($row[0]),
                        'category_id' => $categoryId,
                        'classification_tkdn' => ! empty($row[11]) ? trim($row[11]) : null,
                        'brand' => ! empty($row[2]) ? trim($row[2]) : null,
                        'specification' => ! empty($row[3]) ? trim($row[3]) : null,
                        'tkdn' => ! empty($row[4]) ? (int) $row[4] : 100,
                        'price' => (int) $row[5],
                        'unit' => trim($row[6]),
                        'link' => ! empty($row[7]) ? trim($row[7]) : null,
                        'price_inflasi' => ! empty($row[8]) ? (int) $row[8] : null,
                        'description' => ! empty($row[9]) ? trim($row[9]) : null,
                        'location' => ! empty($row[10]) ? trim($row[10]) : null,
                        'code' => $code,
                    ]);

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Row {$rowNumber}: ".$e->getMessage();
                }

                $rowNumber++;
            }

            DB::commit();

            // Log progress
            $this->importService->logImportProgress('material', $imported, count($rows), $errors);

            if (empty($errors)) {
                return redirect()->route('master.material.index')
                    ->with('success', "Successfully imported {$imported} materials!");
            } else {
                return redirect()->route('master.material.index')
                    ->with('success', "Successfully imported {$imported} materials!")
                    ->with('import_errors', $errors);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('master.material.index')
                ->with('error', 'Import failed: '.$e->getMessage());
        }
    }
}
