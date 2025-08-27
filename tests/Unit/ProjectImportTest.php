<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectImportTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Category $category1;
    protected Category $category2;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test user
        $this->user = User::factory()->create();
        
        // Create test categories
        $this->category1 = Category::factory()->create(['name' => 'Category 1']);
        $this->category2 = Category::factory()->create(['name' => 'Category 2']);
    }

    public function test_can_download_project_import_template(): void
    {
        $response = $this->actingAs($this->user)
            ->get('/master/project/download-template');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename="project_import_template.xlsx"');
    }

    public function test_can_import_projects_successfully(): void
    {
        // Create Excel file content
        $data = [
            ['name', 'description', 'start_date', 'end_date', 'budget', 'status', 'category_name'],
            ['Project A', 'Description A', '2024-01-01', '2024-12-31', '1000000', 'active', 'Category 1'],
            ['Project B', 'Description B', '2024-02-01', '2024-11-30', '2000000', 'active', 'Category 2'],
        ];

        $file = $this->createExcelFile($data, 'projects.xlsx');

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHas('success', 'Data berhasil diimport!');

        // Verify projects were created
        $this->assertDatabaseHas('projects', [
            'name' => 'Project A',
            'description' => 'Description A',
            'budget' => 1000000,
            'status' => 'active'
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'Project B',
            'description' => 'Description B',
            'budget' => 2000000,
            'status' => 'active'
        ]);

        // Verify category relationships
        $projectA = Project::where('name', 'Project A')->first();
        $projectB = Project::where('name', 'Project B')->first();
        
        $this->assertEquals($this->category1->id, $projectA->category_id);
        $this->assertEquals($this->category2->id, $projectB->category_id);
    }

    public function test_import_validates_required_fields(): void
    {
        $data = [
            ['name', 'description', 'start_date', 'end_date', 'budget', 'status', 'category_name'],
            ['', 'Description A', '2024-01-01', '2024-12-31', '1000000', 'active', 'Category 1'], // Missing name
            ['Project B', '', '2024-02-01', '2024-11-30', '2000000', 'active', 'Category 2'], // Missing description
        ];

        $file = $this->createExcelFile($data, 'projects.xlsx');

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHas('import_errors');
        
        $errors = session('import_errors');
        $this->assertCount(2, $errors);
        $this->assertStringContainsString('Nama project wajib diisi', $errors[1]);
        $this->assertStringContainsString('Deskripsi project wajib diisi', $errors[2]);
    }

    public function test_import_validates_category_exists(): void
    {
        $data = [
            ['name', 'description', 'start_date', 'end_date', 'budget', 'status', 'category_name'],
            ['Project A', 'Description A', '2024-01-01', '2024-12-31', '1000000', 'active', 'Non Existent Category'],
        ];

        $file = $this->createExcelFile($data, 'projects.xlsx');

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHas('import_errors');
        
        $errors = session('import_errors');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('Kategori "Non Existent Category" tidak ditemukan', $errors[1]);
    }

    public function test_import_validates_date_format(): void
    {
        $data = [
            ['name', 'description', 'start_date', 'end_date', 'budget', 'status', 'category_name'],
            ['Project A', 'Description A', 'invalid-date', '2024-12-31', '1000000', 'active', 'Category 1'],
        ];

        $file = $this->createExcelFile($data, 'projects.xlsx');

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHas('import_errors');
        
        $errors = session('import_errors');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('Format tanggal tidak valid', $errors[1]);
    }

    public function test_import_validates_budget_format(): void
    {
        $data = [
            ['name', 'description', 'start_date', 'end_date', 'budget', 'status', 'category_name'],
            ['Project A', 'Description A', '2024-01-01', '2024-12-31', 'invalid-budget', 'active', 'Category 1'],
        ];

        $file = $this->createExcelFile($data, 'projects.xlsx');

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHas('import_errors');
        
        $errors = session('import_errors');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('Budget harus berupa angka', $errors[1]);
    }

    public function test_import_validates_file_required(): void
    {
        $response = $this->actingAs($this->user)
            ->post('/master/project/import', []);

        $response->assertRedirect('/master/project');
        $response->assertSessionHasErrors(['excel_file']);
    }

    public function test_import_validates_file_type(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->actingAs($this->user)
            ->post('/master/project/import', [
                'excel_file' => $file
            ]);

        $response->assertRedirect('/master/project');
        $response->assertSessionHasErrors(['excel_file']);
    }

    private function createExcelFile(array $data, string $filename): UploadedFile
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        foreach ($data as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex) . ($rowIndex + 1), $value);
            }
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'test_excel_');
        $writer->save($tempFile);
        
        return new UploadedFile(
            $tempFile,
            $filename,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
    }
}
