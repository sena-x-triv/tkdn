<?php

namespace Database\Seeders;

use App\Models\Hpp;
use App\Models\HppItem;
use App\Models\Project;
use Illuminate\Database\Seeder;

class HppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::first();

        // Buat HPP contoh dengan angka kecil untuk memudahkan perhitungan manual
        $hpp = Hpp::create([
            'code' => 'HPP-'.date('Ymd').'-001',
            'project_id' => $project->id,
            'sub_total_hpp' => 12000, // Total dari semua item HPP
            'overhead_percentage' => 10.00, // 10% overhead
            'overhead_amount' => 1200, // 10% x 12000 = 1200
            'margin_percentage' => 15.00, // 15% margin
            'margin_amount' => 1800, // 15% x 12000 = 1800
            'sub_total' => 15000, // 12000 + 1200 + 1800 = 15000
            'ppn_percentage' => 11.00, // 11% PPN
            'ppn_amount' => 1650, // 11% x 15000 = 1650
            'grand_total' => 16650, // 15000 + 1650 = 16650
            'notes' => 'Note : - Setiap Bulan Maksimal Volume 10 Box, jika melebihi maka ditagihkan additional',
            'status' => 'draft',
        ]);

        // Item 1: Penerimaan dan Pengangkutan Arsip - TKDN 3.1
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'I',
            'description' => 'Penerimaan dan Pengangkutan Arsip Per Box Standard',
            'tkdn_classification' => '3.1',
            'volume' => 10.00, // 10 box
            'unit' => 'Box',
            'duration' => 3, // 3 bulan
            'duration_unit' => 'Bulan',
            'unit_price' => 800.00, // Rp 800 per box
            'total_price' => 8000, // 10 x 800 = 8000
        ]);

        // Item 2: Pemilahan dan Update Database - TKDN 3.2
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'II',
            'description' => 'Pemilahan dan Update Database Arsip Per Box Standard',
            'tkdn_classification' => '3.2',
            'volume' => 10.00, // 10 box
            'unit' => 'Box',
            'duration' => 3, // 3 bulan
            'duration_unit' => 'Bulan',
            'unit_price' => 400.00, // Rp 400 per box
            'total_price' => 4000, // 10 x 400 = 4000
        ]);

        // Item 3: Penyimpanan Arsip - TKDN 3.3
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'III',
            'description' => 'Penyimpanan Arsip Per Box Standart',
            'tkdn_classification' => '3.3',
            'volume' => 10.00, // 10 box
            'unit' => 'Box',
            'duration' => 3, // 3 bulan
            'duration_unit' => 'Bulan',
            'unit_price' => 0.00, // Gratis (sudah termasuk dalam item lain)
            'total_price' => 0, // 10 x 0 = 0
        ]);

        // Item 4: Penataan Arsip - TKDN 3.4
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'IV',
            'description' => 'Penataan Arsip Per Box Arsip Standart',
            'tkdn_classification' => '3.4',
            'volume' => 10.00, // 10 box
            'unit' => 'Box',
            'duration' => 3, // 3 bulan
            'duration_unit' => 'Bulan',
            'unit_price' => 0.00, // Gratis (sudah termasuk dalam item lain)
            'total_price' => 0, // 10 x 0 = 0
        ]);

        // Item 5: Konsultasi Arsip - TKDN 3.5
        HppItem::create([
            'hpp_id' => $hpp->id,
            'item_number' => 'V',
            'description' => 'Konsultasi dan Pengawasan Arsip Per Box',
            'tkdn_classification' => '3.5',
            'volume' => 10.00, // 10 box
            'unit' => 'Box',
            'duration' => 3, // 3 bulan
            'duration_unit' => 'Bulan',
            'unit_price' => 0.00, // Gratis (sudah termasuk dalam item lain)
            'total_price' => 0, // 10 x 0 = 0
        ]);

        // Verifikasi perhitungan:
        // Sub Total HPP: 8000 + 4000 + 0 + 0 + 0 = 12000 ✓
        // Overhead (10%): 12000 x 10% = 1200 ✓
        // Margin (15%): 12000 x 15% = 1800 ✓
        // Sub Total: 12000 + 1200 + 1800 = 15000 ✓
        // PPN (11%): 15000 x 11% = 1650 ✓
        // Grand Total: 15000 + 1650 = 16650 ✓
    }
}
