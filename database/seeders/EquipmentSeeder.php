<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // Get Peralatan category ID
        $peralatanCategory = Category::where('code', 'EQ')->first();
        $categoryId = $peralatanCategory ? $peralatanCategory->id : null;

        $equipment = [
            ['code' => 'EQ001', 'name' => 'Kardus ukuran standard', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 5000, 'description' => 'Ukuran Standard'], // 5,000 per unit
            ['code' => 'EQ002', 'name' => 'Kardus ukuran besar', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 8000, 'description' => 'Ukuran Besar'], // 8,000 per unit
            ['code' => 'EQ003', 'name' => 'Folder ukuran standard', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 2000, 'description' => 'Ukuran Standard'], // 2,000 per unit
            ['code' => 'EQ004', 'name' => 'Folder ukuran besar', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 3000, 'description' => 'Ukuran Besar'], // 3,000 per unit
            ['code' => 'EQ005', 'name' => 'ATK', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 25000, 'description' => 'Pulpen Pencil Penggaris Corrective Peruncing Tempat Penyimpnan'], // 25,000 per set
            ['code' => 'EQ006', 'name' => 'Label/Sticker', 'category_id' => $categoryId, 'tkdn' => 0.00, 'period' => 1, 'price' => 5000, 'description' => 'Label dan Sticker'], // 5,000 per pack
            ['code' => 'EQ007', 'name' => 'Sewa Lemari Arsip', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 30000, 'description' => 'Sewa per bulan'], // 30,000 per bulan
            ['code' => 'EQ008', 'name' => 'Sewa Trolley', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 20000, 'description' => 'Sewa per bulan'], // 20,000 per bulan
            ['code' => 'EQ009', 'name' => 'Sewa Laptop', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 45000, 'description' => 'Sewa per bulan'], // 45,000 per bulan
            ['code' => 'EQ010', 'name' => 'Sewa Printer', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 35000, 'description' => 'Sewa per bulan'], // 35,000 per bulan
            ['code' => 'EQ011', 'name' => 'Sewa Scanner', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 35000, 'description' => 'Sewa per bulan'], // 35,000 per bulan
            ['code' => 'EQ012', 'name' => 'Sewa AC', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 25000, 'description' => 'Sewa per bulan'], // 25,000 per bulan
            ['code' => 'EQ013', 'name' => 'Sewa CCTV', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 15000, 'description' => 'Sewa per bulan'], // 15,000 per bulan
            ['code' => 'EQ014', 'name' => 'Sewa Handheld', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 40000, 'description' => 'Sewa per bulan'], // 40,000 per bulan
            ['code' => 'EQ015', 'name' => 'Sewa Truck Engkel', 'category_id' => $categoryId, 'tkdn' => 75.00, 'period' => 30, 'price' => 45000, 'description' => 'Sewa per bulan'], // 45,000 per bulan
            ['code' => 'EQ016', 'name' => 'Truck - Tol Parkir BBM PP < 40 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 25000, 'description' => 'Per trip'], // 25,000 per trip
            ['code' => 'EQ017', 'name' => 'Truck - Tol Parkir BBM PP 40 - 80 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 35000, 'description' => 'Per trip'], // 35,000 per trip
            ['code' => 'EQ018', 'name' => 'Truck - Tol Parkir BBM PP > 80 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 45000, 'description' => 'Per trip'], // 45,000 per trip
            ['code' => 'EQ019', 'name' => 'KRP - Tol Parkir BBM PP < 40 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 15000, 'description' => 'Per trip'], // 15,000 per trip
            ['code' => 'EQ020', 'name' => 'KRP - Tol Parkir BBM PP 40 - 80 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 25000, 'description' => 'Per trip'], // 25,000 per trip
            ['code' => 'EQ021', 'name' => 'KRP - Tol Parkir BBM PP > 80 KM', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 1, 'price' => 35000, 'description' => 'Per trip'], // 35,000 per trip
            ['code' => 'EQ022', 'name' => 'Listrik', 'category_id' => $categoryId, 'tkdn' => 100.00, 'period' => 30, 'price' => 40000, 'description' => 'Biaya per bulan'], // 40,000 per bulan
        ];

        foreach ($equipment as $item) {
            Equipment::firstOrCreate(['code' => $item['code']], $item);
        }

        // Verifikasi perhitungan:
        // Total biaya peralatan sekali pakai: 5000 + 8000 + 2000 + 3000 + 25000 + 5000 = 50,000
        // Total biaya sewa per bulan: 30000 + 20000 + 45000 + 35000 + 35000 + 25000 + 15000 + 40000 + 45000 = 300,000
        // Total biaya transport per trip: 25000 + 35000 + 45000 + 15000 + 25000 + 35000 = 180,000
        // Total biaya listrik per bulan: 40,000
        // Total semua: 50,000 + 300,000 + 180,000 + 40,000 = 570,000
        // Rata-rata TKDN: (0 + 0 + 0 + 0 + 0 + 0 + 75 + 75 + 75 + 75 + 75 + 75 + 75 + 75 + 75 + 100 + 100 + 100 + 100 + 100 + 100 + 100) / 22 = 65.91%
    }
}
