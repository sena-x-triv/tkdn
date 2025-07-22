<?php

namespace Database\Seeders;

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
        $workers = [
            ['name' => 'Pekerja/ Kenek', 'unit' => 'OH', 'price' => 193459, 'tkdn' => 100],
            ['name' => 'Tukang Gali', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Kepala Tukang Batu', 'unit' => 'OH', 'price' => 221519, 'tkdn' => 100],
            ['name' => 'Tukang Batu', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Kepala Tukang Kayu', 'unit' => 'OH', 'price' => 221175, 'tkdn' => 100],
            ['name' => 'Tukang Kayu', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Kepala Tukang Besi', 'unit' => 'OH', 'price' => 221175, 'tkdn' => 100],
            ['name' => 'Tukang Besi', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Kepala Tukang Cat', 'unit' => 'OH', 'price' => 221175, 'tkdn' => 100],
            ['name' => 'Tukang Cat', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Tukang Aspal', 'unit' => 'OH', 'price' => 193459, 'tkdn' => 100],
            ['name' => 'Mandor', 'unit' => 'OH', 'price' => 234012, 'tkdn' => 100],
            ['name' => 'Instalator', 'unit' => 'OH', 'price' => 221175, 'tkdn' => 100],
            ['name' => 'Pembantu Instalator', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Tukang Babat Rumput', 'unit' => 'OH', 'price' => 193459, 'tkdn' => 100],
            ['name' => 'Kepala Tuaking Pasang Pipa/Ledeng', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Tukang Pasang Pipa', 'unit' => 'OH', 'price' => 193459, 'tkdn' => 100],
            ['name' => 'Operator Alat Berat', 'unit' => 'OH', 'price' => 234012, 'tkdn' => 100],
            ['name' => 'Pembantu Operator Alat berat', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Tukang Las', 'unit' => 'OH', 'price' => 203519, 'tkdn' => 100],
            ['name' => 'Arsiparis', 'unit' => 'OH', 'price' => 450000, 'tkdn' => 100],
            ['name' => 'Angkut Bongkar Muat', 'unit' => 'OH', 'price' => 235000, 'tkdn' => 100],
            ['name' => 'Driver', 'unit' => 'OH', 'price' => 270000, 'tkdn' => 100],
            ['name' => 'Security', 'unit' => 'OH', 'price' => 270000, 'tkdn' => 100],
            ['name' => 'General Worker', 'unit' => 'OH', 'price' => 250000, 'tkdn' => 100],
            ['name' => 'Administrasi Keproyekan', 'unit' => 'OH', 'price' => 320000, 'tkdn' => 100],
            ['name' => 'Pelaksana', 'unit' => 'OH', 'price' => 320000, 'tkdn' => 100],
        ];

        foreach ($workers as $worker) {
            Worker::create($worker);
        }
    }
}
 