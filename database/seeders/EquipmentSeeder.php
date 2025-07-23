<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * PERALATAN
     */
    public function run(): void
    {
        $equipment = [
            ['name' => 'Kardus ukuran standard', 'tkdn' => 0.00, 'period' => 1, 'price' => 31500, 'description' => 'Ukuran Standard'],
            ['name' => 'Kardus ukuran besar', 'tkdn' => 0.00, 'period' => 1, 'price' => 55000, 'description' => 'Ukuran Besar'],
            ['name' => 'Folder ukuran standard', 'tkdn' => 0.00, 'period' => 1, 'price' => 500, 'description' => 'Ukuran Standard'],
            ['name' => 'Folder ukuran besar', 'tkdn' => 0.00, 'period' => 1, 'price' => 1000, 'description' => 'Ukuran Besar'],
            ['name' => 'ATK', 'tkdn' => 0.00, 'period' => 1, 'price' => 350000, 'description' => 'Pulpen Pencil Penggaris Corrective Peruncing Tempat Penyimpnan'],
            ['name' => 'Label/Sticker', 'tkdn' => 0.00, 'period' => 1, 'price' => 20000, 'description' => ''],
            ['name' => 'Sewa Lemari Arsip', 'tkdn' => 75.00, 'period' => 30, 'price' => 600000, 'description' => ''],
            ['name' => 'Sewa Trolley', 'tkdn' => 75.00, 'period' => 30, 'price' => 450000, 'description' => ''],
            ['name' => 'Sewa Laptop', 'tkdn' => 75.00, 'period' => 30, 'price' => 1000000, 'description' => ''],
            ['name' => 'Sewa Printer', 'tkdn' => 75.00, 'period' => 30, 'price' => 1200000, 'description' => ''],
            ['name' => 'Sewa Scanner', 'tkdn' => 75.00, 'period' => 30, 'price' => 1200000, 'description' => ''],
            ['name' => 'Sewa AC', 'tkdn' => 75.00, 'period' => 30, 'price' => 500000, 'description' => ''],
            ['name' => 'Sewa CCTV', 'tkdn' => 75.00, 'period' => 30, 'price' => 100000, 'description' => ''],
            ['name' => 'Sewa Handheld', 'tkdn' => 75.00, 'period' => 30, 'price' => 1000000, 'description' => ''],
            ['name' => 'Sewa Truck Engkel', 'tkdn' => 75.00, 'period' => 30, 'price' => 1700000, 'description' => ''],
            ['name' => 'Truck - Tol Parkir BBM PP < 40 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 400000, 'description' => ''],
            ['name' => 'Truck - Tol Parkir BBM PP 40 - 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 650000, 'description' => ''],
            ['name' => 'Truck - Tol Parkir BBM PP > 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 1000000, 'description' => ''],
            ['name' => 'KRP - Tol Parkir BBM PP < 40 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 250000, 'description' => ''],
            ['name' => 'KRP - Tol Parkir BBM PP 40 - 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 500000, 'description' => ''],
            ['name' => 'KRP - Tol Parkir BBM PP > 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 800000, 'description' => ''],
            ['name' => 'Listrik', 'tkdn' => 100.00, 'period' => 30, 'price' => 5000000, 'description' => '']
        ];


        foreach ($equipment as $item) {
            Equipment::create($item);
        }
    }
}
 