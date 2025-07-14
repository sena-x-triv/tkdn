<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = [
            ['name' => 'Tukang Batu', 'unit' => 'OH', 'price' => 85000, 'tkdn' => 95.5],
            ['name' => 'Tukang Kayu', 'unit' => 'OH', 'price' => 90000, 'tkdn' => 92.3],
            ['name' => 'Tukang Besi', 'unit' => 'OH', 'price' => 95000, 'tkdn' => 88.7],
            ['name' => 'Tukang Cat', 'unit' => 'OH', 'price' => 80000, 'tkdn' => 94.2],
            ['name' => 'Tukang Listrik', 'unit' => 'OH', 'price' => 100000, 'tkdn' => 85.9],
            ['name' => 'Tukang Plumbing', 'unit' => 'OH', 'price' => 95000, 'tkdn' => 87.4],
            ['name' => 'Tukang Las', 'unit' => 'OH', 'price' => 110000, 'tkdn' => 82.1],
            ['name' => 'Tukang Keramik', 'unit' => 'OH', 'price' => 90000, 'tkdn' => 91.6],
            ['name' => 'Tukang Kaca', 'unit' => 'OH', 'price' => 85000, 'tkdn' => 89.3],
            ['name' => 'Tukang Atap', 'unit' => 'OH', 'price' => 95000, 'tkdn' => 86.8],
            ['name' => 'Tukang Paving', 'unit' => 'OH', 'price' => 80000, 'tkdn' => 93.7],
            ['name' => 'Tukang Taman', 'unit' => 'OH', 'price' => 75000, 'tkdn' => 96.2],
            ['name' => 'Tukang Finishing', 'unit' => 'OH', 'price' => 85000, 'tkdn' => 90.5],
            ['name' => 'Tukang Struktur', 'unit' => 'OH', 'price' => 100000, 'tkdn' => 84.3],
            ['name' => 'Tukang Mekanikal', 'unit' => 'OH', 'price' => 105000, 'tkdn' => 83.9],
        ];

        foreach ($workers as $worker) {
            Worker::create($worker);
        }
    }
}
