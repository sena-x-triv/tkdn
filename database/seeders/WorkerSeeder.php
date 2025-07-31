<?php

namespace Database\Seeders;

use App\Models\Worker;
use App\Models\Category;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * PEKERJA
     */
    public function run(): void
    {
        // Get Pekerja category ID
        $workerCategory = Category::where('code', 'PJ')->first();
        $categoryId = $workerCategory ? $workerCategory->id : null;

        $workers = [
            ['code' => 'PJ001', 'name' => 'Pekerja/ Kenek', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 193459, 'tkdn' => 100],
            ['code' => 'PJ002', 'name' => 'Tukang Gali', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ003', 'name' => 'Kepala Tukang Batu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 221519, 'tkdn' => 100],
            ['code' => 'PJ004', 'name' => 'Tukang Batu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ005', 'name' => 'Kepala Tukang Kayu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 221175, 'tkdn' => 100],
            ['code' => 'PJ006', 'name' => 'Tukang Kayu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ007', 'name' => 'Kepala Tukang Besi', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 221175, 'tkdn' => 100],
            ['code' => 'PJ008', 'name' => 'Tukang Besi', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ009', 'name' => 'Kepala Tukang Cat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 221175, 'tkdn' => 100],
            ['code' => 'PJ010', 'name' => 'Tukang Cat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ011', 'name' => 'Tukang Aspal', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 193459, 'tkdn' => 100],
            ['code' => 'PJ012', 'name' => 'Mandor', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 234012, 'tkdn' => 100],
            ['code' => 'PJ013', 'name' => 'Instalator', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 221175, 'tkdn' => 100],
            ['code' => 'PJ014', 'name' => 'Pembantu Instalator', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ015', 'name' => 'Tukang Babat Rumput', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 193459, 'tkdn' => 100],
            ['code' => 'PJ016', 'name' => 'Kepala Tuaking Pasang Pipa/Ledeng', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ017', 'name' => 'Tukang Pasang Pipa', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 193459, 'tkdn' => 100],
            ['code' => 'PJ018', 'name' => 'Operator Alat Berat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 234012, 'tkdn' => 100],
            ['code' => 'PJ019', 'name' => 'Pembantu Operator Alat berat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ020', 'name' => 'Tukang Las', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 203519, 'tkdn' => 100],
            ['code' => 'PJ021', 'name' => 'Arsiparis', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 450000, 'tkdn' => 100],
            ['code' => 'PJ022', 'name' => 'Angkut Bongkar Muat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 235000, 'tkdn' => 100],
            ['code' => 'PJ023', 'name' => 'Driver', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 270000, 'tkdn' => 100],
            ['code' => 'PJ024', 'name' => 'Security', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 270000, 'tkdn' => 100],
            ['code' => 'PJ025', 'name' => 'General Worker', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 250000, 'tkdn' => 100],
            ['code' => 'PJ026', 'name' => 'Administrasi Keproyekan', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 320000, 'tkdn' => 100],
            ['code' => 'PJ027', 'name' => 'Pelaksana', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 320000, 'tkdn' => 100],
        ];

        foreach ($workers as $worker) {
            Worker::firstOrCreate(['code' => $worker['code']], $worker);
        }
    }
}
 