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
            ['code' => 'EQ001', 'name' => 'Kardus ukuran standard', 'tkdn' => 0.00, 'period' => 1, 'price' => 31500, 'description' => 'Ukuran Standard'],
            ['code' => 'EQ002', 'name' => 'Kardus ukuran besar', 'tkdn' => 0.00, 'period' => 1, 'price' => 55000, 'description' => 'Ukuran Besar'],
            ['code' => 'EQ003', 'name' => 'Folder ukuran standard', 'tkdn' => 0.00, 'period' => 1, 'price' => 500, 'description' => 'Ukuran Standard'],
            ['code' => 'EQ004', 'name' => 'Folder ukuran besar', 'tkdn' => 0.00, 'period' => 1, 'price' => 1000, 'description' => 'Ukuran Besar'],
            ['code' => 'EQ005', 'name' => 'ATK', 'tkdn' => 0.00, 'period' => 1, 'price' => 350000, 'description' => 'Pulpen Pencil Penggaris Corrective Peruncing Tempat Penyimpnan'],
            ['code' => 'EQ006', 'name' => 'Label/Sticker', 'tkdn' => 0.00, 'period' => 1, 'price' => 20000, 'description' => ''],
            ['code' => 'EQ007', 'name' => 'Sewa Lemari Arsip', 'tkdn' => 75.00, 'period' => 30, 'price' => 600000, 'description' => ''],
            ['code' => 'EQ008', 'name' => 'Sewa Trolley', 'tkdn' => 75.00, 'period' => 30, 'price' => 450000, 'description' => ''],
            ['code' => 'EQ009', 'name' => 'Sewa Laptop', 'tkdn' => 75.00, 'period' => 30, 'price' => 1000000, 'description' => ''],
            ['code' => 'EQ010', 'name' => 'Sewa Printer', 'tkdn' => 75.00, 'period' => 30, 'price' => 1200000, 'description' => ''],
            ['code' => 'EQ011', 'name' => 'Sewa Scanner', 'tkdn' => 75.00, 'period' => 30, 'price' => 1200000, 'description' => ''],
            ['code' => 'EQ012', 'name' => 'Sewa AC', 'tkdn' => 75.00, 'period' => 30, 'price' => 500000, 'description' => ''],
            ['code' => 'EQ013', 'name' => 'Sewa CCTV', 'tkdn' => 75.00, 'period' => 30, 'price' => 100000, 'description' => ''],
            ['code' => 'EQ014', 'name' => 'Sewa Handheld', 'tkdn' => 75.00, 'period' => 30, 'price' => 1000000, 'description' => ''],
            ['code' => 'EQ015', 'name' => 'Sewa Truck Engkel', 'tkdn' => 75.00, 'period' => 30, 'price' => 1700000, 'description' => ''],
            ['code' => 'EQ016', 'name' => 'Truck - Tol Parkir BBM PP < 40 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 400000, 'description' => ''],
            ['code' => 'EQ017', 'name' => 'Truck - Tol Parkir BBM PP 40 - 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 650000, 'description' => ''],
            ['code' => 'EQ018', 'name' => 'Truck - Tol Parkir BBM PP > 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 1000000, 'description' => ''],
            ['code' => 'EQ019', 'name' => 'KRP - Tol Parkir BBM PP < 40 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 250000, 'description' => ''],
            ['code' => 'EQ020', 'name' => 'KRP - Tol Parkir BBM PP 40 - 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 500000, 'description' => ''],
            ['code' => 'EQ021', 'name' => 'KRP - Tol Parkir BBM PP > 80 KM', 'tkdn' => 100.00, 'period' => 1, 'price' => 800000, 'description' => ''],
            ['code' => 'EQ022', 'name' => 'Listrik', 'tkdn' => 100.00, 'period' => 30, 'price' => 5000000, 'description' => '']
        ];


        foreach ($equipment as $item) {
            Equipment::firstOrCreate(['code' => $item['code']], $item);
        }
    }
}
 