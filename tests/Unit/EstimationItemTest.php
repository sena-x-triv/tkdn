<?php

namespace Tests\Unit;

use App\Models\Estimation;
use App\Models\EstimationItem;
use App\Models\Worker;
use App\Models\Material;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstimationItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_estimation_item_fillable_fields()
    {
        $data = [
            'estimation_id' => 1,
            'category' => 'worker',
            'reference_id' => 'ulid123',
            'code' => 'W001',
            'coefficient' => 2,
            'unit_price' => 50000,
            'total_price' => 100000,
            'equipment_name' => 'Tukang Batu',
        ];
        $item = new EstimationItem($data);
        foreach ($data as $key => $value) {
            $this->assertEquals($value, $item->$key);
        }
    }

    public function test_estimation_item_belongs_to_estimation()
    {
        $estimation = Estimation::factory()->create();
        $item = EstimationItem::factory()->create(['estimation_id' => $estimation->id]);
        $this->assertInstanceOf(Estimation::class, $item->estimation);
        $this->assertEquals($estimation->id, $item->estimation->id);
    }

    public function test_estimation_item_worker_relation()
    {
        $worker = Worker::factory()->create();
        $item = EstimationItem::factory()->create([
            'category' => 'worker',
            'reference_id' => $worker->id,
        ]);
        $this->assertInstanceOf(Worker::class, $item->worker);
        $this->assertEquals($worker->id, $item->worker->id);
    }

    public function test_estimation_item_material_relation()
    {
        $material = Material::factory()->create();
        $item = EstimationItem::factory()->create([
            'category' => 'material',
            'reference_id' => $material->id,
        ]);
        $this->assertInstanceOf(Material::class, $item->material);
        $this->assertEquals($material->id, $item->material->id);
    }

    public function test_estimation_item_equipment_relation()
    {
        $equipment = Equipment::factory()->create();
        $item = EstimationItem::factory()->create([
            'category' => 'equipment',
            'reference_id' => $equipment->id,
        ]);
        $this->assertInstanceOf(Equipment::class, $item->equipment);
        $this->assertEquals($equipment->id, $item->equipment->id);
    }
} 