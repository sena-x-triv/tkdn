<?php

namespace Tests\Feature;

use App\Models\TkdnItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TkdnTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function user_can_view_tkdn_index_page()
    {
        $response = $this->actingAs($this->user)->get(route('master.tkdn.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.index');
        $response->assertViewHas('tkdnItems');
    }

    /** @test */
    public function user_can_view_tkdn_create_page()
    {
        $response = $this->actingAs($this->user)->get(route('master.tkdn.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.create');
        $response->assertViewHas('classifications');
    }

    /** @test */
    public function user_can_create_tkdn_item()
    {
        $data = [
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item TKDN',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
            'description' => 'Test description',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->user)->post(route('master.tkdn.store'), $data);

        $response->assertRedirect(route('master.tkdn.index'));
        $this->assertDatabaseHas('tkdn_items', $data);
    }

    /** @test */
    public function user_cannot_create_tkdn_item_with_duplicate_code()
    {
        // Create first item
        TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'First Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        // Try to create second item with same code
        $data = [
            'code' => 'A.6.3.5.1',
            'name' => 'Second Item',
            'tkdn_classification' => '3.2',
            'unit' => 'Box',
            'unit_price' => 60000,
        ];

        $response = $this->actingAs($this->user)->post(route('master.tkdn.store'), $data);

        $response->assertSessionHasErrors('code');
        $this->assertDatabaseMissing('tkdn_items', [
            'name' => 'Second Item'
        ]);
    }

    /** @test */
    public function user_can_view_tkdn_show_page()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        $response = $this->actingAs($this->user)->get(route('master.tkdn.show', $tkdnItem));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.show');
        $response->assertViewHas('tkdnItem');
    }

    /** @test */
    public function user_can_view_tkdn_edit_page()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        $response = $this->actingAs($this->user)->get(route('master.tkdn.edit', $tkdnItem));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.edit');
        $response->assertViewHas('tkdnItem');
        $response->assertViewHas('classifications');
    }

    /** @test */
    public function user_can_update_tkdn_item()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Original Name',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        $updateData = [
            'code' => 'A.6.3.5.1',
            'name' => 'Updated Name',
            'tkdn_classification' => '3.2',
            'unit' => 'Box',
            'unit_price' => 60000,
            'description' => 'Updated description',
            // is_active tidak dikirim untuk membuat false
        ];

        $response = $this->actingAs($this->user)->put(route('master.tkdn.update', $tkdnItem), $updateData);

        $response->assertRedirect(route('master.tkdn.show', $tkdnItem));
        $this->assertDatabaseHas('tkdn_items', [
            'code' => 'A.6.3.5.1',
            'name' => 'Updated Name',
            'tkdn_classification' => '3.2',
            'unit' => 'Box',
            'unit_price' => 60000,
            'description' => 'Updated description',
            'is_active' => 0, // Boolean false is stored as 0 in database
        ]);
    }

    /** @test */
    public function user_can_delete_tkdn_item()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        $response = $this->actingAs($this->user)->delete(route('master.tkdn.destroy', $tkdnItem));

        $response->assertRedirect(route('master.tkdn.index'));
        $this->assertDatabaseMissing('tkdn_items', ['id' => $tkdnItem->id]);
    }

    /** @test */
    public function user_can_toggle_tkdn_item_status()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user)->patch(route('master.tkdn.toggle-status', $tkdnItem));

        $response->assertRedirect();
        $this->assertDatabaseHas('tkdn_items', [
            'id' => $tkdnItem->id,
            'is_active' => false
        ]);
    }

    /** @test */
    public function user_can_view_tkdn_breakdown_page()
    {
        $response = $this->actingAs($this->user)->get(route('master.tkdn.breakdown'));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.breakdown');
        $response->assertViewHas('breakdown');
    }

    /** @test */
    public function user_can_view_tkdn_breakdown_with_custom_parameters()
    {
        $response = $this->actingAs($this->user)->get(route('master.tkdn.breakdown', [
            'volume' => 500,
            'duration' => 6,
            'overhead' => 10,
            'margin' => 15,
            'ppn' => 11
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.breakdown');
        $response->assertViewHas('volume', 500);
        $response->assertViewHas('duration', 6);
        $response->assertViewHas('overheadPercentage', 10);
        $response->assertViewHas('marginPercentage', 15);
        $response->assertViewHas('ppnPercentage', 11);
    }

    /** @test */
    public function user_can_view_tkdn_breakdown_print_page()
    {
        $response = $this->actingAs($this->user)->get(route('master.tkdn.breakdown.print'));

        $response->assertStatus(200);
        $response->assertViewIs('tkdn.print');
        $response->assertViewHas('breakdown');
    }

    /** @test */
    public function tkdn_item_can_calculate_total_price()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 100000,
        ]);

        $totalPrice = $tkdnItem->calculateTotalPrice(600, 12);
        $expectedPrice = 100000 * 600 * 12;

        $this->assertEquals($expectedPrice, $totalPrice);
    }

    /** @test */
    public function tkdn_item_has_formatted_unit_price()
    {
        $tkdnItem = TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 100000,
        ]);

        $formattedPrice = $tkdnItem->formatted_unit_price;

        $this->assertEquals('Rp 100.000', $formattedPrice);
    }

    /** @test */
    public function tkdn_item_can_be_filtered_by_classification()
    {
        TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Item 3.1',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
        ]);

        TkdnItem::create([
            'code' => 'A.6.3.5.2',
            'name' => 'Item 3.2',
            'tkdn_classification' => '3.2',
            'unit' => 'Box',
            'unit_price' => 60000,
        ]);

        $items = TkdnItem::byClassification('3.1')->get();

        $this->assertCount(1, $items);
        $this->assertEquals('3.1', $items->first()->tkdn_classification);
    }

    /** @test */
    public function tkdn_item_can_be_filtered_by_active_status()
    {
        TkdnItem::create([
            'code' => 'A.6.3.5.1',
            'name' => 'Active Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => 50000,
            'is_active' => true,
        ]);

        TkdnItem::create([
            'code' => 'A.6.3.5.2',
            'name' => 'Inactive Item',
            'tkdn_classification' => '3.2',
            'unit' => 'Box',
            'unit_price' => 60000,
            'is_active' => false,
        ]);

        $activeItems = TkdnItem::active()->get();

        $this->assertCount(1, $activeItems);
        $this->assertTrue($activeItems->first()->is_active);
    }

    /** @test */
    public function validation_prevents_invalid_tkdn_classification()
    {
        $data = [
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.5', // Invalid classification
            'unit' => 'Box',
            'unit_price' => 50000,
        ];

        $response = $this->actingAs($this->user)->post(route('master.tkdn.store'), $data);

        $response->assertSessionHasErrors('tkdn_classification');
    }

    /** @test */
    public function validation_prevents_negative_unit_price()
    {
        $data = [
            'code' => 'A.6.3.5.1',
            'name' => 'Test Item',
            'tkdn_classification' => '3.1',
            'unit' => 'Box',
            'unit_price' => -1000, // Negative price
        ];

        $response = $this->actingAs($this->user)->post(route('master.tkdn.store'), $data);

        $response->assertSessionHasErrors('unit_price');
    }
}
