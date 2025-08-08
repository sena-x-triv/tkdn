<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hpp;
use App\Models\HppItem;
use Illuminate\Support\Str;

class HppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat HPP contoh sesuai dengan gambar
        $hpp = Hpp::create([
            'code' => 'HPP-' . date('Ymd') . '-001',
            'title' => 'HPP',
            'company_name' => 'PT JUARA DATA',
            'work_description' => 'PEKERJAAN PENGANGKUTAN, PENATAAN DAN PENYIMPANAN ARSIP',
            'sub_total_hpp' => 1294026000,
            'overhead_percentage' => 8.00,
            'overhead_amount' => 103522080,
            'margin_percentage' => 12.00,
            'margin_amount' => 155283120,
            'sub_total' => 1552831200,
            'ppn_percentage' => 11.00,
            'ppn_amount' => 170811432,
            'grand_total' => 1723642632,
            'notes' => 'Note : - Setiap Bulan Maksimal Volume 600 Box, jika melebihi maka ditagihkan additional',
            'status' => 'draft',
        ]);

        // Item 1: Penerimaan dan Pengangkutan Arsip
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'I',
            'description' => 'Penerimaan dan Pengangkutan Arsip Per Box Standard',
            'tkdn_classification' => '3.1',
            'volume' => 600.00,
            'unit' => 'Box',
            'duration' => 12,
            'duration_unit' => 'Bulan',
            'unit_price' => 77325.00,
            'total_price' => 556740000,
        ]);

        // Item 2: Pemilahan dan Update Database
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'II',
            'description' => 'Pemilahan dan Update Database Arsip Per Box Standard',
            'tkdn_classification' => '3.2',
            'volume' => 600.00,
            'unit' => 'Box',
            'duration' => 12,
            'duration_unit' => 'Bulan',
            'unit_price' => 66425.00,
            'total_price' => 478260000,
        ]);

        // Item 3: Penyimpanan Arsip
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'III',
            'description' => 'Penyimpanan Arsip Per Box Standart',
            'tkdn_classification' => '3.3',
            'volume' => 600.00,
            'unit' => 'Box',
            'duration' => 12,
            'duration_unit' => 'Bulan',
            'unit_price' => 35975.83,
            'total_price' => 259026000,
        ]);

        // Item 4: Penataan Arsip
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'IV',
            'description' => 'Penataan Arsip Per Box Arsip Standart',
            'tkdn_classification' => '3.4',
            'volume' => 600.00,
            'unit' => 'Box',
            'duration' => 12,
            'duration_unit' => 'Bulan',
            'unit_price' => 44758.33,
            'total_price' => 322260000,
        ]);
    }
}
