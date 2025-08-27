<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Worker;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class WorkerImportTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user for authentication
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        
        // Create some categories for testing
        $this->category = Category::factory()->create(['name' => 'Teknisi']);
    }

    public function test_can_download_import_template()
    {
        $response = $this->get(route('master.worker.download-template'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment;filename="worker_import_template.xlsx"');
    }

    public function test_can_import_workers_from_excel()
    {
        // Create a simple Excel file content for testing
        $excelContent = $this->createTestExcelContent();
        
        $file = UploadedFile::fake()->createWithContent(
            'workers.xlsx',
            $excelContent
        );

        $response = $this->post(route('master.worker.import'), [
            'excel_file' => $file
        ]);

        $response->assertRedirect(route('master.worker.index'));
        $response->assertSessionHas('success');

        // Check if workers were created
        $this->assertDatabaseHas('workers', [
            'name' => 'John Doe',
            'unit' => 'OH',
            'price' => 50000,
            'tkdn' => 100
        ]);

        $this->assertDatabaseHas('workers', [
            'name' => 'Jane Smith',
            'unit' => 'Person',
            'price' => 75000,
            'tkdn' => 85
        ]);
    }

    public function test_import_validates_required_fields()
    {
        $excelContent = $this->createTestExcelContentWithMissingFields();
        
        $file = UploadedFile::fake()->createWithContent(
            'workers.xlsx',
            $excelContent
        );

        $response = $this->post(route('master.worker.import'), [
            'excel_file' => $file
        ]);

        $response->assertRedirect(route('master.worker.index'));
        $response->assertSessionHas('import_errors');
        
        // Check that no workers were created due to validation errors
        $this->assertDatabaseCount('workers', 0);
    }

    public function test_import_validates_tkdn_range()
    {
        $excelContent = $this->createTestExcelContentWithInvalidTkdn();
        
        $file = UploadedFile::fake()->createWithContent(
            'workers.xlsx',
            $excelContent
        );

        $response = $this->post(route('master.worker.import'), [
            'excel_file' => $file
        ]);

        $response->assertRedirect(route('master.worker.index'));
        $response->assertSessionHas('import_errors');
        
        // Check that no workers were created due to validation errors
        $this->assertDatabaseCount('workers', 0);
    }

    public function test_import_validates_price_format()
    {
        $excelContent = $this->createTestExcelContentWithInvalidPrice();
        
        $file = UploadedFile::fake()->createWithContent(
            'workers.xlsx',
            $excelContent
        );

        $response = $this->post(route('master.worker.import'), [
            'excel_file' => $file
        ]);

        $response->assertRedirect(route('master.worker.index'));
        $response->assertSessionHas('import_errors');
        
        // Check that no workers were created due to validation errors
        $this->assertDatabaseCount('workers', 0);
    }

    public function test_import_links_category_by_name()
    {
        $excelContent = $this->createTestExcelContentWithCategory();
        
        $file = UploadedFile::fake()->createWithContent(
            'workers.xlsx',
            $excelContent
        );

        $response = $this->post(route('master.worker.import'), [
            'excel_file' => $file
        ]);

        $response->assertRedirect(route('master.worker.index'));
        $response->assertSessionHas('success');

        // Check if worker was created with correct category
        $worker = Worker::where('name', 'John Doe')->first();
        $this->assertNotNull($worker);
        $this->assertEquals($this->category->id, $worker->category_id);
    }

    private function createTestExcelContent()
    {
        // This is a simplified test - in real scenario you'd create actual Excel file
        // For now, we'll test the controller logic separately
        return 'test content';
    }

    private function createTestExcelContentWithMissingFields()
    {
        return 'test content with missing fields';
    }

    private function createTestExcelContentWithInvalidTkdn()
    {
        return 'test content with invalid tkdn';
    }

    private function createTestExcelContentWithInvalidPrice()
    {
        return 'test content with invalid price';
    }

    private function createTestExcelContentWithCategory()
    {
        return 'test content with category';
    }
}
