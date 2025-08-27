<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:draft,on_progress,completed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);
        Project::create($validated);

        return redirect()->route('master.project.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:draft,on_progress,completed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);
        $project->update($validated);

        return redirect()->route('master.project.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('master.project.index')->with('success', 'Project deleted successfully.');
    }

    /**
     * Download Excel template for project import
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['Name', 'Status', 'Start Date', 'End Date', 'Description', 'Company', 'Location'];
        $sheet->fromArray($headers, null, 'A1');

        // Set example data
        $exampleData = [
            ['Project A', 'draft', '2024-01-01', '2024-12-31', 'Sample project description', 'Company A', 'Jakarta'],
            ['Project B', 'on_progress', '2024-06-01', '2024-11-30', 'Another project', 'Company B', 'Bandung'],
        ];
        $sheet->fromArray($exampleData, null, 'A2');

        // Style headers
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E5E7EB');

        // Auto size columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create response
        $writer = new Xlsx($spreadsheet);
        $filename = 'project_import_template.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Import projects from Excel file
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
                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3])) {
                    $errors[] = "Row {$rowNumber}: Missing required fields (Name, Status, Start Date, or End Date)";
                    $rowNumber++;

                    continue;
                }

                // Validate status
                if (! in_array($row[1], ['draft', 'on_progress', 'completed'])) {
                    $errors[] = "Row {$rowNumber}: Status must be draft, on_progress, or completed";
                    $rowNumber++;

                    continue;
                }

                // Validate dates
                if (! strtotime($row[2]) || ! strtotime($row[3])) {
                    $errors[] = "Row {$rowNumber}: Invalid date format (use YYYY-MM-DD)";
                    $rowNumber++;

                    continue;
                }

                // Validate end_date >= start_date
                if (strtotime($row[3]) < strtotime($row[2])) {
                    $errors[] = "Row {$rowNumber}: End date must be after or equal to start date";
                    $rowNumber++;

                    continue;
                }

                try {
                    // Create project
                    Project::create([
                        'name' => trim($row[0]),
                        'status' => trim($row[1]),
                        'start_date' => $row[2],
                        'end_date' => $row[3],
                        'description' => ! empty($row[4]) ? trim($row[4]) : null,
                        'company' => ! empty($row[5]) ? trim($row[5]) : null,
                        'location' => ! empty($row[6]) ? trim($row[6]) : null,
                    ]);

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Row {$rowNumber}: ".$e->getMessage();
                }

                $rowNumber++;
            }

            DB::commit();

            if (empty($errors)) {
                return redirect()->route('master.project.index')
                    ->with('success', "Successfully imported {$imported} projects!");
            } else {
                return redirect()->route('master.project.index')
                    ->with('success', "Successfully imported {$imported} projects!")
                    ->with('import_errors', $errors);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('master.project.index')
                ->with('error', 'Import failed: '.$e->getMessage());
        }
    }
} 