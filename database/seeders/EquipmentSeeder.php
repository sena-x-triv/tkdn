<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipment = [
            ['name' => 'Excavator Mini', 'tkdn' => 85.2, 'period' => 30, 'price' => 2500000, 'description' => 'Excavator mini untuk galian kecil'],
            ['name' => 'Crane Tower', 'tkdn' => 72.8, 'period' => 90, 'price' => 15000000, 'description' => 'Crane tower untuk konstruksi tinggi'],
            ['name' => 'Concrete Mixer', 'tkdn' => 91.5, 'period' => 45, 'price' => 1800000, 'description' => 'Mesin pengaduk beton'],
            ['name' => 'Vibrator Beton', 'tkdn' => 88.3, 'period' => 20, 'price' => 450000, 'description' => 'Alat vibrator untuk pemadatan beton'],
            ['name' => 'Jack Hammer', 'tkdn' => 94.7, 'period' => 15, 'price' => 350000, 'description' => 'Palu bor untuk pemecahan beton'],
            ['name' => 'Welding Machine', 'tkdn' => 76.4, 'period' => 25, 'price' => 800000, 'description' => 'Mesin las untuk pekerjaan besi'],
            ['name' => 'Generator Set', 'tkdn' => 68.9, 'period' => 60, 'price' => 3200000, 'description' => 'Genset untuk sumber listrik'],
            ['name' => 'Air Compressor', 'tkdn' => 82.1, 'period' => 30, 'price' => 1200000, 'description' => 'Kompresor udara untuk alat pneumatik'],
            ['name' => 'Scaffolding', 'tkdn' => 95.8, 'period' => 40, 'price' => 2800000, 'description' => 'Perancah untuk pekerjaan tinggi'],
            ['name' => 'Water Pump', 'tkdn' => 89.6, 'period' => 20, 'price' => 650000, 'description' => 'Pompa air untuk dewatering'],
            ['name' => 'Bulldozer', 'tkdn' => 71.3, 'period' => 50, 'price' => 8500000, 'description' => 'Bulldozer untuk pekerjaan tanah'],
            ['name' => 'Dump Truck', 'tkdn' => 69.7, 'period' => 35, 'price' => 4500000, 'description' => 'Truk untuk angkut material'],
            ['name' => 'Concrete Pump', 'tkdn' => 74.2, 'period' => 55, 'price' => 12000000, 'description' => 'Pompa beton untuk pengecoran'],
            ['name' => 'Drilling Machine', 'tkdn' => 81.5, 'period' => 25, 'price' => 950000, 'description' => 'Mesin bor untuk fondasi'],
            ['name' => 'Crane Mobile', 'tkdn' => 67.8, 'period' => 40, 'price' => 8500000, 'description' => 'Crane mobile untuk angkat material'],
        ];

        foreach ($equipment as $item) {
            Equipment::create($item);
        }
    }
}
 