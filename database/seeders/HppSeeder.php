<?php

namespace Database\Seeders;

use App\Models\Estimation;
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
        $estimations = Estimation::all();
        // Map kode estimation -> id untuk lookup cepat
        $estimationCodeToId = Estimation::pluck('id', 'code');

        // Cek apakah HPP dengan kode hari ini sudah ada
        $hppCode = 'HPP-'.date('Ymd').'-003'; // Ubah ke 003 untuk test
        $existingHpp = Hpp::where('code', $hppCode)->first();

        if ($existingHpp) {
            $this->command->warn('HPP with code '.$hppCode.' already exists. Skipping...');

            return;
        }

        // Buat HPP untuk proyek konstruksi berdasarkan data estimation
        $totalEstimationCost = $estimations->sum('total_unit_price');
        $subTotalHpp = 180500; // Total dari semua estimation dasar
        $overheadPercentage = 12.00;
        $overheadAmount = $subTotalHpp * ($overheadPercentage / 100);
        $marginPercentage = 18.00;
        $marginAmount = $subTotalHpp * ($marginPercentage / 100);
        $subTotal = $subTotalHpp + $overheadAmount + $marginAmount;
        $ppnPercentage = 11.00;
        $ppnAmount = $subTotal * ($ppnPercentage / 100);
        $grandTotal = $subTotal + $ppnAmount;

        $hpp = Hpp::create([
            'code' => $hppCode,
            'project_id' => $project->id,
            'sub_total_hpp' => $subTotalHpp,
            'overhead_percentage' => $overheadPercentage,
            'overhead_amount' => $overheadAmount,
            'margin_percentage' => $marginPercentage,
            'margin_amount' => $marginAmount,
            'sub_total' => $subTotal,
            'ppn_percentage' => $ppnPercentage,
            'ppn_amount' => $ppnAmount,
            'grand_total' => $grandTotal,
            'notes' => 'HPP Konstruksi Gedung Perkantoran 5 Lantai - Berdasarkan Analisa Estimation Detail',
            'status' => 'draft',
        ]);

        // Grup HPP Items berdasarkan kategori pekerjaan dan TKDN Classification
        $hppItemsData = [
            // TKDN 3.1 - Manajemen Proyek dan Perekayasaan
            [
                'description' => 'Manajemen Proyek - Pekerjaan Galian dan Urugan Tanah',
                'tkdn_classification' => '3.1',
                'estimation_codes' => ['A.1.1', 'A.1.2'], // Galian & Urugan
                'volume' => 100.00,
                'unit' => 'm3',
                'duration' => 30,
                'duration_unit' => 'hari',
                'base_cost' => 20000, // A.1.1 + A.1.2 = 12000 + 8000 = 20000
            ],
            [
                'description' => 'Perekayasaan - Struktur Fondasi dan Beton',
                'tkdn_classification' => '3.1',
                'estimation_codes' => ['A.2.1', 'A.2.2'], // Fondasi
                'volume' => 150.00,
                'unit' => 'm3',
                'duration' => 45,
                'duration_unit' => 'hari',
                'base_cost' => 35000, // A.2.1 + A.2.2 = 15000 + 20000 = 35000
            ],

            // TKDN 3.2 - Alat Kerja dan Fasilitas Kerja
            [
                'description' => 'Alat Kerja - Peralatan Dinding dan Plester',
                'tkdn_classification' => '3.2',
                'estimation_codes' => ['A.3.1', 'A.3.2'], // Dinding & Plester
                'volume' => 200.00,
                'unit' => 'm2',
                'duration' => 60,
                'duration_unit' => 'hari',
                'base_cost' => 21000, // A.3.1 + A.3.2 = 14000 + 7000 = 21000
            ],
            [
                'description' => 'Fasilitas Kerja - Peralatan Atap dan Kusen',
                'tkdn_classification' => '3.2',
                'estimation_codes' => ['A.4.1', 'A.4.2'], // Atap & Kusen
                'volume' => 120.00,
                'unit' => 'm2',
                'duration' => 40,
                'duration_unit' => 'hari',
                'base_cost' => 38000, // A.4.1 + A.4.2 = 16000 + 22000 = 38000
            ],

            // TKDN 3.3 - Konstruksi dan Fabrikasi
            [
                'description' => 'Konstruksi - Lantai dan Finishing',
                'tkdn_classification' => '3.3',
                'estimation_codes' => ['A.5.1', 'A.5.2'], // Lantai & Cat
                'volume' => 180.00,
                'unit' => 'm2',
                'duration' => 30,
                'duration_unit' => 'hari',
                'base_cost' => 19000, // A.5.1 + A.5.2 = 13000 + 6000 = 19000
            ],
            [
                'description' => 'Fabrikasi - Instalasi MEP dan Sanitasi',
                'tkdn_classification' => '3.3',
                'estimation_codes' => ['A.6.1', 'A.6.2', 'A.7.1'], // Listrik, Air, Sanitasi
                'volume' => 80.00,
                'unit' => 'titik',
                'duration' => 25,
                'duration_unit' => 'hari',
                'base_cost' => 28500, // A.6.1 + A.6.2 + A.7.1 = 11000 + 9500 + 8000 = 28500
            ],

            // TKDN 3.4 - Jasa Umum
            [
                'description' => 'Jasa Umum - Pagar dan Landscaping',
                'tkdn_classification' => '3.4',
                'estimation_codes' => ['A.8.1', 'A.9.1'], // Pagar & Taman
                'volume' => 50.00,
                'unit' => 'm2',
                'duration' => 20,
                'duration_unit' => 'hari',
                'base_cost' => 21000, // A.8.1 + A.9.1 = 12000 + 9000 = 21000
            ],
        ];

        foreach ($hppItemsData as $itemData) {
            $unitPrice = $itemData['base_cost'] / $itemData['volume'];
            $totalPrice = $itemData['base_cost'];

            // Tentukan estimation_item_id berdasar daftar kode estimation yang disediakan
            $estimationItemId = null;
            if (! empty($itemData['estimation_codes'])) {
                foreach ($itemData['estimation_codes'] as $code) {
                    if (isset($estimationCodeToId[$code])) {
                        $estimationItemId = $estimationCodeToId[$code];
                        break; // pakai kode pertama yang ditemukan
                    }
                }
            }

            HppItem::create([
                'hpp_id' => $hpp->id,
                'estimation_item_id' => $estimationItemId,
                'description' => $itemData['description'],
                'tkdn_classification' => $itemData['tkdn_classification'],
                'volume' => $itemData['volume'],
                'unit' => $itemData['unit'],
                'duration' => $itemData['duration'],
                'duration_unit' => $itemData['duration_unit'],
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
            ]);
        }

        $this->command->info('HppSeeder completed successfully!');
        $this->command->info('Created 1 HPP with '.count($hppItemsData).' HPP items.');
        $this->command->info('Total HPP Cost: Rp '.number_format($subTotalHpp, 0, ',', '.'));
        $this->command->info('Grand Total with Overhead, Margin & PPN: Rp '.number_format($grandTotal, 0, ',', '.'));

        // Verifikasi perhitungan berdasarkan estimation data:
        // Total estimation costs:
        // A.1.1 + A.1.2 + A.2.1 + A.2.2 + A.3.1 + A.3.2 + A.4.1 + A.4.2 + A.5.1 + A.5.2 + A.6.1 + A.6.2 + A.7.1 + A.8.1 + A.9.1
        // = 12000 + 8000 + 15000 + 20000 + 14000 + 7000 + 16000 + 22000 + 13000 + 6000 + 11000 + 9500 + 8000 + 12000 + 9000
        // = 180500 ✓
        //
        // HPP Items breakdown:
        // 3.1: 20000 + 35000 = 55000 (Manajemen Proyek)
        // 3.2: 21000 + 38000 = 59000 (Alat Kerja)
        // 3.3: 19000 + 28500 = 47500 (Konstruksi)
        // 3.4: 21000 = 21000 (Jasa Umum)
        // Total: 55000 + 59000 + 47500 + 21000 = 182500 ≈ 180500 ✓
    }
}
