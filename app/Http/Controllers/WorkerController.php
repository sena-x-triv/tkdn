<?php

namespace App\Http\Controllers;

use App\Contracts\CodeGenerationServiceInterface;
use App\Models\Category;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WorkerController extends Controller
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

    public function index()
    {
        $workers = Worker::with('category')->paginate(10);

        return view('worker.index', compact('workers'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('worker.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
            'location' => 'nullable|string',
        ]);

        // Generate code otomatis
        $code = $this->codeGenerationService->generateCode('worker');

        $data = $request->all();
        $data['code'] = $code;

        Worker::create($data);

        return redirect()->route('master.worker.index')->with('success', 'Worker created with code: '.$code);
    }

    public function show(Worker $worker)
    {
        return view('worker.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        $categories = Category::orderBy('name')->get();

        return view('worker.edit', compact('worker', 'categories'));
    }

    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
            'location' => 'nullable|string',
        ]);
        $worker->update($request->all());

        return redirect()->route('master.worker.index')->with('success', 'Worker updated!');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();

        return redirect()->route('master.worker.index')->with('success', 'Worker deleted!');
    }

    /**
     * Download Excel template for worker import
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['Name', 'Unit', 'Category', 'Price', 'TKDN', 'Location'];
        $sheet->fromArray($headers, null, 'A1');

        // Set example data
        $exampleData = [
            ['John Doe', 'OH', 'Teknisi', '50000', '100', 'Jakarta'],
            ['Jane Smith', 'Person', 'Operator', '75000', '85', 'Bandung'],
        ];
        $sheet->fromArray($exampleData, null, 'A2');

        // Style headers
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E5E7EB');

        // Auto size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create response
        $writer = new Xlsx($spreadsheet);
        $filename = 'worker_import_template.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Import workers from Excel file
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
                if (empty($row[0]) || empty($row[1]) || empty($row[3]) || empty($row[4])) {
                    $errors[] = "Row {$rowNumber}: Missing required fields (Name, Unit, Price, or TKDN)";
                    $rowNumber++;

                    continue;
                }

                // Find category by name if provided
                $categoryId = null;
                if (! empty($row[2])) {
                    $category = Category::where('name', 'LIKE', '%'.trim($row[2]).'%')->first();
                    if ($category) {
                        $categoryId = $category->id;
                    } else {
                        $errors[] = "Row {$rowNumber}: Kategori \"".trim($row[2]).'" tidak ditemukan';
                        $rowNumber++;

                        continue;
                    }
                }

                // Validate TKDN range
                if (! is_numeric($row[4]) || $row[4] < 0 || $row[4] > 100) {
                    $errors[] = "Row {$rowNumber}: TKDN must be a number between 0-100";
                    $rowNumber++;

                    continue;
                }

                // Validate Price
                if (! is_numeric($row[3]) || $row[3] < 0) {
                    $errors[] = "Row {$rowNumber}: Price must be a positive number";
                    $rowNumber++;

                    continue;
                }

                try {

                    // Generate code
                    $code = $this->codeGenerationService->generateCode('worker');

                    // Create worker
                    Worker::create([
                        'name' => trim($row[0]),
                        'unit' => trim($row[1]),
                        'category_id' => $categoryId,
                        'price' => (int) $row[3],
                        'tkdn' => (int) $row[4],
                        'location' => ! empty($row[5]) ? trim($row[5]) : null,
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
                return redirect()->route('master.worker.index')
                    ->with('success', "Successfully imported {$imported} workers!");
            } else {
                return redirect()->route('master.worker.index')
                    ->with('success', "Successfully imported {$imported} workers!")
                    ->with('import_errors', $errors);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('master.worker.index')
                ->with('error', 'Import failed: '.$e->getMessage());
        }
    }
}
