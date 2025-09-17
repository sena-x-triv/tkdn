<?php

namespace Tests\Feature;

use App\Models\Hpp;
use App\Models\HppItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HppProjectTypeFilteringTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_filters_hpp_items_for_tkdn_jasa_project()
    {
        // Create TKDN Jasa project
        $project = Project::factory()->create(['project_type' => 'tkdn_jasa']);
        $hpp = Hpp::factory()->create(['project_id' => $project->id]);

        // Create HPP items with different classifications
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
            'description' => 'TKDN Jasa Item 3.1',
            'total_price' => 1000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.2',
            'description' => 'TKDN Jasa Item 3.2',
            'total_price' => 2000000,
        ]);

        // Create items that should be filtered out (4.x classifications)
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
            'description' => 'TKDN Barang Jasa Item 4.1',
            'total_price' => 3000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.2',
            'description' => 'TKDN Barang Jasa Item 4.2',
            'total_price' => 4000000,
        ]);

        // Test getHppData API
        $response = $this->get("/service/get-hpp-data?project_id={$project->id}");

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue($data['success']);
        $this->assertCount(1, $data['data']);

        $hppData = $data['data'][0];
        $this->assertEquals(2, $hppData['items_count']); // Only 3.1 and 3.2 items
        $this->assertEquals('tkdn_jasa', $hppData['project_type']);

        // Check tkdn_breakdown only contains 3.x classifications
        $this->assertArrayHasKey('3.1', $hppData['tkdn_breakdown']);
        $this->assertArrayHasKey('3.2', $hppData['tkdn_breakdown']);
        $this->assertArrayNotHasKey('4.1', $hppData['tkdn_breakdown']);
        $this->assertArrayNotHasKey('4.2', $hppData['tkdn_breakdown']);

        // Check counts and costs
        $this->assertEquals(1, $hppData['tkdn_breakdown']['3.1']['count']);
        $this->assertEquals(1000000, $hppData['tkdn_breakdown']['3.1']['total_cost']);
        $this->assertEquals(1, $hppData['tkdn_breakdown']['3.2']['count']);
        $this->assertEquals(2000000, $hppData['tkdn_breakdown']['3.2']['total_cost']);
    }

    /** @test */
    public function it_filters_hpp_items_for_tkdn_barang_jasa_project()
    {
        // Create TKDN Barang & Jasa project
        $project = Project::factory()->create(['project_type' => 'tkdn_barang_jasa']);
        $hpp = Hpp::factory()->create(['project_id' => $project->id]);

        // Create HPP items with different classifications
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
            'description' => 'TKDN Barang Jasa Item 4.1',
            'total_price' => 1000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.2',
            'description' => 'TKDN Barang Jasa Item 4.2',
            'total_price' => 2000000,
        ]);

        // Create items that should be filtered out (3.x classifications)
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
            'description' => 'TKDN Jasa Item 3.1',
            'total_price' => 3000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.2',
            'description' => 'TKDN Jasa Item 3.2',
            'total_price' => 4000000,
        ]);

        // Test getHppData API
        $response = $this->get("/service/get-hpp-data?project_id={$project->id}");

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue($data['success']);
        $this->assertCount(1, $data['data']);

        $hppData = $data['data'][0];
        $this->assertEquals(2, $hppData['items_count']); // Only 4.1 and 4.2 items
        $this->assertEquals('tkdn_barang_jasa', $hppData['project_type']);

        // Check tkdn_breakdown only contains 4.x classifications
        $this->assertArrayHasKey('4.1', $hppData['tkdn_breakdown']);
        $this->assertArrayHasKey('4.2', $hppData['tkdn_breakdown']);
        $this->assertArrayNotHasKey('3.1', $hppData['tkdn_breakdown']);
        $this->assertArrayNotHasKey('3.2', $hppData['tkdn_breakdown']);

        // Check counts and costs
        $this->assertEquals(1, $hppData['tkdn_breakdown']['4.1']['count']);
        $this->assertEquals(1000000, $hppData['tkdn_breakdown']['4.1']['total_cost']);
        $this->assertEquals(1, $hppData['tkdn_breakdown']['4.2']['count']);
        $this->assertEquals(2000000, $hppData['tkdn_breakdown']['4.2']['total_cost']);
    }

    /** @test */
    public function it_generates_service_with_only_matching_hpp_items()
    {
        // Create TKDN Jasa project
        $project = Project::factory()->create(['project_type' => 'tkdn_jasa']);
        $hpp = Hpp::factory()->create(['project_id' => $project->id]);

        // Create HPP items with 3.x classifications (should be included)
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
            'description' => 'TKDN Jasa Item 3.1',
            'total_price' => 1000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.2',
            'description' => 'TKDN Jasa Item 3.2',
            'total_price' => 2000000,
        ]);

        // Create items with 4.x classifications (should be filtered out)
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
            'description' => 'TKDN Barang Jasa Item 4.1',
            'total_price' => 3000000,
        ]);

        // Generate service
        $response = $this->post(route('service.store'), [
            'hpp_id' => $hpp->id,
        ]);

        $response->assertRedirect();

        $service = Service::latest()->first();
        $this->assertEquals('tkdn_jasa', $service->form_category);
        $this->assertEquals('project', $service->service_type);

        // Check that only 3.x service items were created
        $serviceItems = $service->items;
        $this->assertGreaterThan(0, $serviceItems->count());

        $classifications = $serviceItems->pluck('tkdn_classification')->unique()->toArray();
        $this->assertContains('3.1', $classifications);
        $this->assertContains('3.2', $classifications);
        $this->assertNotContains('4.1', $classifications);
    }

    /** @test */
    public function it_handles_empty_hpp_items_for_project_type()
    {
        // Create TKDN Jasa project
        $project = Project::factory()->create(['project_type' => 'tkdn_jasa']);
        $hpp = Hpp::factory()->create(['project_id' => $project->id]);

        // Create only 4.x items (should be filtered out)
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
            'description' => 'TKDN Barang Jasa Item 4.1',
            'total_price' => 1000000,
        ]);

        // Test getHppData API
        $response = $this->get("/service/get-hpp-data?project_id={$project->id}");

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue($data['success']);
        $this->assertCount(1, $data['data']);

        $hppData = $data['data'][0];
        $this->assertEquals(0, $hppData['items_count']); // No matching items
        $this->assertEquals('tkdn_jasa', $hppData['project_type']);
        $this->assertEmpty($hppData['tkdn_breakdown']);
    }

    /** @test */
    public function it_handles_mixed_classifications_correctly()
    {
        // Create TKDN Jasa project
        $project = Project::factory()->create(['project_type' => 'tkdn_jasa']);
        $hpp = Hpp::factory()->create(['project_id' => $project->id]);

        // Create mixed items
        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.1',
            'description' => 'TKDN Jasa Item 3.1',
            'total_price' => 1000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '4.1',
            'description' => 'TKDN Barang Jasa Item 4.1',
            'total_price' => 2000000,
        ]);

        HppItem::factory()->create([
            'hpp_id' => $hpp->id,
            'tkdn_classification' => '3.2',
            'description' => 'TKDN Jasa Item 3.2',
            'total_price' => 3000000,
        ]);

        // Test getHppData API
        $response = $this->get("/service/get-hpp-data?project_id={$project->id}");

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue($data['success']);
        $hppData = $data['data'][0];

        // Should only include 3.x items
        $this->assertEquals(2, $hppData['items_count']);
        $this->assertArrayHasKey('3.1', $hppData['tkdn_breakdown']);
        $this->assertArrayHasKey('3.2', $hppData['tkdn_breakdown']);
        $this->assertArrayNotHasKey('4.1', $hppData['tkdn_breakdown']);

        // Check total cost only includes filtered items
        $totalCost = $hppData['tkdn_breakdown']['3.1']['total_cost'] + $hppData['tkdn_breakdown']['3.2']['total_cost'];
        $this->assertEquals(4000000, $totalCost); // 1000000 + 3000000
    }
}
