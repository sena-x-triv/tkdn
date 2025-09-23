<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceGenerateFormTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication with admin role
        $this->user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->user);
    }

    public function test_can_generate_form_3_1(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.1']));

        $response->assertRedirect(route('service.show', $service));
        $response->assertSessionHas('success', 'Form 3.1 TKDN berhasil dibuat.');
    }

    public function test_can_generate_form_3_2(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.2']));

        $response->assertRedirect(route('service.show', $service));
        $response->assertSessionHas('success', 'Form 3.2 TKDN berhasil dibuat.');
    }

    public function test_can_generate_form_3_3(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.3']));

        $response->assertRedirect(route('service.show', $service));
        $response->assertSessionHas('success', 'Form 3.3 TKDN berhasil dibuat.');
    }

    public function test_can_generate_form_3_4(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.4']));

        $response->assertRedirect(route('service.show', $service));
        $response->assertSessionHas('success', 'Form 3.4 TKDN berhasil dibuat.');
    }

    public function test_can_generate_form_3_5(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.5']));

        $response->assertRedirect(route('service.show', $service));
        $response->assertSessionHas('success', 'Form 3.5 TKDN berhasil dibuat.');
    }

    public function test_rejects_invalid_form_number(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.6']));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Nomor form TKDN tidak valid.');
    }

    public function test_generate_form_creates_service_items(): void
    {
        $project = Project::factory()->create();
        $service = Service::factory()->create([
            'project_id' => $project->id,
            'status' => 'draft',
        ]);

        // Create HPP and related data
        $hpp = \App\Models\Hpp::factory()->create(['project_id' => $project->id]);

        // Create estimation item with worker
        $estimation = \App\Models\Estimation::factory()->create();
        $worker = \App\Models\Worker::factory()->create(['classification_tkdn' => 1]);
        $estimationItem = \App\Models\EstimationItem::factory()->create([
            'estimation_id' => $estimation->id,
            'category' => 'worker',
            'reference_id' => $worker->id,
        ]);

        // Create HPP item
        \App\Models\HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'estimation_item_id' => $estimationItem->id,
            'description' => 'Test Item 1',
            'volume' => 1,
            'duration' => 12,
            'duration_unit' => 'bulan',
            'total_price' => 1000000,
        ]);

        $response = $this->post(route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.1']));

        $response->assertRedirect(route('service.show', $service));

        // Check if service items were created
        $this->assertDatabaseHas('service_items', [
            'service_id' => $service->id,
            'tkdn_classification' => '3.1',
        ]);
    }
}
