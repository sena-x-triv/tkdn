<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Worker;
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
            ['code' => 'PJ001', 'name' => 'Pekerja/ Kenek', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 15000, 'tkdn' => 100], // 15,000 per jam
            ['code' => 'PJ002', 'name' => 'Tukang Gali', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 18000, 'tkdn' => 100], // 18,000 per jam
            ['code' => 'PJ003', 'name' => 'Kepala Tukang Batu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ004', 'name' => 'Tukang Batu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ005', 'name' => 'Kepala Tukang Kayu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ006', 'name' => 'Tukang Kayu', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ007', 'name' => 'Kepala Tukang Besi', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ008', 'name' => 'Tukang Besi', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ009', 'name' => 'Kepala Tukang Cat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ010', 'name' => 'Tukang Cat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ011', 'name' => 'Tukang Aspal', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 15000, 'tkdn' => 100], // 15,000 per jam
            ['code' => 'PJ012', 'name' => 'Mandor', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 30000, 'tkdn' => 100], // 30,000 per jam
            ['code' => 'PJ013', 'name' => 'Instalator', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ014', 'name' => 'Pembantu Instalator', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ015', 'name' => 'Tukang Babat Rumput', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 15000, 'tkdn' => 100], // 15,000 per jam
            ['code' => 'PJ016', 'name' => 'Kepala Tuaking Pasang Pipa/Ledeng', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ017', 'name' => 'Tukang Pasang Pipa', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 15000, 'tkdn' => 100], // 15,000 per jam
            ['code' => 'PJ018', 'name' => 'Operator Alat Berat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 30000, 'tkdn' => 100], // 30,000 per jam
            ['code' => 'PJ019', 'name' => 'Pembantu Operator Alat berat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ020', 'name' => 'Tukang Las', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ021', 'name' => 'Arsiparis', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 35000, 'tkdn' => 100], // 35,000 per jam
            ['code' => 'PJ022', 'name' => 'Angkut Bongkar Muat', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 18000, 'tkdn' => 100], // 18,000 per jam
            ['code' => 'PJ023', 'name' => 'Driver', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ024', 'name' => 'Security', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 20000, 'tkdn' => 100], // 20,000 per jam
            ['code' => 'PJ025', 'name' => 'General Worker', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 18000, 'tkdn' => 100], // 18,000 per jam
            ['code' => 'PJ026', 'name' => 'Administrasi Keproyekan', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
            ['code' => 'PJ027', 'name' => 'Pelaksana', 'unit' => 'OH', 'category_id' => $categoryId, 'price' => 25000, 'tkdn' => 100], // 25,000 per jam
        ];

        foreach ($workers as $worker) {
            Worker::firstOrCreate(['code' => $worker['code']], $worker);
        }

        // Verifikasi perhitungan:
        // Total biaya pekerja per jam: 15000 + 18000 + 25000 + 20000 + 25000 + 20000 + 25000 + 20000 + 25000 + 20000 + 15000 + 30000 + 25000 + 20000 + 15000 + 20000 + 15000 + 30000 + 20000 + 20000 + 35000 + 18000 + 20000 + 20000 + 18000 + 25000 + 25000 = 605,000
        // Rata-rata biaya per jam: 605,000 / 27 = 22,407.41
        // Semua pekerja memiliki TKDN 100% (WNI)
    }
}
