<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceFormCategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->user);
    }

    public function test_service_model_has_form_categories(): void
    {
        $formCategories = Service::getFormCategories();

        $this->assertArrayHasKey('tkdn_jasa', $formCategories);
        $this->assertArrayHasKey('tkdn_barang_jasa', $formCategories);
        $this->assertEquals('TKDN Jasa (Form 3.1 - 3.5)', $formCategories['tkdn_jasa']);
        $this->assertEquals('TKDN Barang & Jasa (Form 4.1 - 4.7)', $formCategories['tkdn_barang_jasa']);
    }

    public function test_service_can_have_tkdn_jasa_category(): void
    {
        $project = Project::factory()->create();

        $service = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Test Service',
            'form_category' => Service::CATEGORY_TKDN_JASA,
            'service_type' => Service::TYPE_PROJECT,
            'status' => 'draft',
        ]);

        $this->assertEquals(Service::CATEGORY_TKDN_JASA, $service->form_category);
        $this->assertEquals('TKDN Jasa (Form 3.1 - 3.5)', $service->getFormCategoryLabel());
    }

    public function test_service_can_have_tkdn_barang_jasa_category(): void
    {
        $project = Project::factory()->create();

        $service = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Test Service',
            'form_category' => Service::CATEGORY_TKDN_BARANG_JASA,
            'service_type' => Service::TYPE_PROJECT,
            'status' => 'draft',
        ]);

        $this->assertEquals(Service::CATEGORY_TKDN_BARANG_JASA, $service->form_category);
        $this->assertEquals('TKDN Barang & Jasa (Form 4.1 - 4.7)', $service->getFormCategoryLabel());
    }

    public function test_service_returns_correct_available_forms_for_tkdn_jasa(): void
    {
        $project = Project::factory()->create();

        $service = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Test Service',
            'form_category' => Service::CATEGORY_TKDN_JASA,
            'service_type' => Service::TYPE_PROJECT,
            'status' => 'draft',
        ]);

        $availableForms = $service->getAvailableForms();

        $this->assertArrayHasKey('3.1', $availableForms);
        $this->assertArrayHasKey('3.2', $availableForms);
        $this->assertArrayHasKey('3.3', $availableForms);
        $this->assertArrayHasKey('3.4', $availableForms);
        $this->assertArrayHasKey('3.5', $availableForms);
        $this->assertArrayNotHasKey('4.1', $availableForms);
    }

    public function test_service_returns_correct_available_forms_for_tkdn_barang_jasa(): void
    {
        $project = Project::factory()->create();

        $service = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Test Service',
            'form_category' => Service::CATEGORY_TKDN_BARANG_JASA,
            'service_type' => Service::TYPE_PROJECT,
            'status' => 'draft',
        ]);

        $availableForms = $service->getAvailableForms();

        $this->assertArrayHasKey('4.1', $availableForms);
        $this->assertArrayHasKey('4.2', $availableForms);
        $this->assertArrayHasKey('4.3', $availableForms);
        $this->assertArrayHasKey('4.4', $availableForms);
        $this->assertArrayHasKey('4.5', $availableForms);
        $this->assertArrayHasKey('4.6', $availableForms);
        $this->assertArrayHasKey('4.7', $availableForms);
        $this->assertArrayNotHasKey('3.1', $availableForms);
    }

    public function test_service_create_page_shows_auto_determination_info(): void
    {
        $response = $this->get(route('service.create'));

        $response->assertStatus(200);
        $response->assertSee('Kategori Form TKDN');
        $response->assertSee('Otomatis Ditentukan');
        $response->assertSee('Kategori form akan ditentukan otomatis berdasarkan jenis form yang tersedia di HPP yang dipilih');
    }

    public function test_service_edit_page_shows_readonly_form_category(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'form_category' => Service::CATEGORY_TKDN_JASA,
        ]);

        $response = $this->get(route('service.edit', $service));

        $response->assertStatus(200);
        $response->assertSee('Kategori Form TKDN');
        $response->assertSee('TKDN Jasa (Form 3.1 - 3.5)');
        $response->assertSee('Ditentukan otomatis berdasarkan form yang tersedia di HPP');
    }

    public function test_service_show_page_displays_form_category_badge(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'form_category' => Service::CATEGORY_TKDN_JASA,
        ]);

        $response = $this->get(route('service.show', $service));

        $response->assertStatus(200);
        $response->assertSee('TKDN Jasa (Form 3.1 - 3.5)');
    }

    public function test_service_show_page_displays_hero_header_elements(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'form_category' => Service::CATEGORY_TKDN_JASA,
        ]);

        $response = $this->get(route('service.show', $service));

        $response->assertStatus(200);
        $response->assertSee('Services'); // Breadcrumb
        $response->assertSee('Detail Service'); // Breadcrumb
        $response->assertSee($service->service_name); // Service name
        $response->assertSee($service->getFormTitle()); // Form title
        $response->assertSee('Project'); // Info card
        $response->assertSee('Total Cost'); // Info card
        $response->assertSee('TKDN %'); // Info card
        $response->assertSee('Items'); // Info card
    }

    public function test_form_category_determined_automatically_from_hpp_with_form3(): void
    {
        $project = Project::factory()->create();
        $hpp = \App\Models\Hpp::factory()->create([
            'project_id' => $project->id,
        ]);

        // Create HPP items with form 3.x classifications
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
        ]);
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.2',
        ]);

        $response = $this->post(route('service.store'), [
            'hpp_id' => $hpp->id,
            'service_type' => 'project',
        ]);

        $response->assertRedirect();

        $service = Service::latest()->first();
        $this->assertEquals(Service::CATEGORY_TKDN_JASA, $service->form_category);
    }

    public function test_form_category_determined_automatically_from_hpp_with_form4(): void
    {
        $project = Project::factory()->create();
        $hpp = \App\Models\Hpp::factory()->create([
            'project_id' => $project->id,
        ]);

        // Create HPP items with form 4.x classifications
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
        ]);
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.2',
        ]);

        $response = $this->post(route('service.store'), [
            'hpp_id' => $hpp->id,
            'service_type' => 'project',
        ]);

        $response->assertRedirect();

        $service = Service::latest()->first();
        $this->assertEquals(Service::CATEGORY_TKDN_BARANG_JASA, $service->form_category);
    }

    public function test_form_category_prioritizes_form4_over_form3(): void
    {
        $project = Project::factory()->create();
        $hpp = \App\Models\Hpp::factory()->create([
            'project_id' => $project->id,
        ]);

        // Create HPP items with both form 3.x and 4.x classifications
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
        ]);
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
        ]);

        $response = $this->post(route('service.store'), [
            'hpp_id' => $hpp->id,
            'service_type' => 'project',
        ]);

        $response->assertRedirect();

        $service = Service::latest()->first();
        $this->assertEquals(Service::CATEGORY_TKDN_BARANG_JASA, $service->form_category);
    }
}
