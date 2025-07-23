<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    use RefreshDatabase;

    public function test_material_index_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('master.material.index'))
            ->assertStatus(200)
            ->assertSee('Material');
    }

    public function test_material_can_be_created()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Test Material',
            'specification' => 'Spec',
            'unit' => 'Kg',
            'price' => 5000,
            'tkdn' => 70,
        ];
        $this->actingAs($user)
            ->post(route('master.material.store'), $data)
            ->assertRedirect(route('master.material.index'));
        $this->assertDatabaseHas('materials', ['name' => 'Test Material']);
    }

    public function test_material_can_be_updated()
    {
        $user = User::factory()->create();
        $material = Material::factory()->create();
        $this->actingAs($user)
            ->put(route('master.material.update', $material), [
                'name' => 'Updated',
                'specification' => $material->specification,
                'unit' => $material->unit,
                'price' => $material->price,
                'tkdn' => $material->tkdn,
            ])
            ->assertRedirect(route('master.material.index'));
        $this->assertDatabaseHas('materials', ['name' => 'Updated']);
    }

    public function test_material_can_be_deleted()
    {
        $user = User::factory()->create();
        $material = Material::factory()->create();
        $this->actingAs($user)
            ->delete(route('master.material.destroy', $material))
            ->assertRedirect(route('master.material.index'));
        $this->assertDatabaseMissing('materials', ['id' => $material->id]);
    }
} 