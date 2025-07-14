<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Semen Portland', 'specification' => 'Type I 50kg', 'unit' => 'Zak', 'price' => 85000, 'tkdn' => 78.5],
            ['name' => 'Pasir Beton', 'specification' => 'Kualitas A', 'unit' => 'm3', 'price' => 250000, 'tkdn' => 95.2],
            ['name' => 'Batu Split', 'specification' => '1/2 cm', 'unit' => 'm3', 'price' => 280000, 'tkdn' => 92.8],
            ['name' => 'Bata Merah', 'specification' => 'Ukuran Standar', 'unit' => 'Buah', 'price' => 1200, 'tkdn' => 98.1],
            ['name' => 'Besi Beton', 'specification' => 'D10', 'unit' => 'Kg', 'price' => 15000, 'tkdn' => 65.3],
            ['name' => 'Kayu Balok', 'specification' => '5/7 cm', 'unit' => 'm3', 'price' => 3500000, 'tkdn' => 85.7],
            ['name' => 'Paku', 'specification' => '3 inch', 'unit' => 'Kg', 'price' => 25000, 'tkdn' => 72.4],
            ['name' => 'Cat Tembok', 'specification' => 'Vinyl 20kg', 'unit' => 'Kaleng', 'price' => 180000, 'tkdn' => 68.9],
            ['name' => 'Keramik Lantai', 'specification' => '40x40 cm', 'unit' => 'm2', 'price' => 85000, 'tkdn' => 55.2],
            ['name' => 'Genteng', 'specification' => 'Press', 'unit' => 'Buah', 'price' => 3500, 'tkdn' => 88.6],
            ['name' => 'Kaca', 'specification' => '5mm', 'unit' => 'm2', 'price' => 120000, 'tkdn' => 45.8],
            ['name' => 'Pipa PVC', 'specification' => '4 inch', 'unit' => 'm', 'price' => 45000, 'tkdn' => 62.3],
            ['name' => 'Kabel Listrik', 'specification' => 'NYM 2x2.5', 'unit' => 'm', 'price' => 8500, 'tkdn' => 58.7],
            ['name' => 'Paving Block', 'specification' => 'Bata 21x10.5x6', 'unit' => 'm2', 'price' => 95000, 'tkdn' => 91.4],
            ['name' => 'Semen Instan', 'specification' => 'Mortar 25kg', 'unit' => 'Sak', 'price' => 65000, 'tkdn' => 74.6],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
