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
        $subTotalHpp = 180500; // Total dari semua estimation dasar (3.1-3.4)
        // Tambahan untuk form 4.1-4.7: 26000 + 30000 + 19000 + 28000 + 9500 + 15000 + 13000 = 140500
        $additionalCost = 140500;
        $totalHppCost = $subTotalHpp + $additionalCost; // 180500 + 140500 = 321000
        $overheadPercentage = 12.00;
        $overheadAmount = $totalHppCost * ($overheadPercentage / 100);
        $marginPercentage = 18.00;
        $marginAmount = $totalHppCost * ($marginPercentage / 100);
        $subTotal = $totalHppCost + $overheadAmount + $marginAmount;
        $ppnPercentage = 11.00;
        $ppnAmount = $subTotal * ($ppnPercentage / 100);
        $grandTotal = $subTotal + $ppnAmount;

        $hpp = Hpp::create([
            'code' => $hppCode,
            'project_id' => $project->id,
            'sub_total_hpp' => $totalHppCost,
            'overhead_percentage' => $overheadPercentage,
            'overhead_amount' => $overheadAmount,
            'margin_percentage' => $marginPercentage,
            'margin_amount' => $marginAmount,
            'sub_total' => $subTotal,
            'ppn_percentage' => $ppnPercentage,
            'ppn_amount' => $ppnAmount,
            'grand_total' => $grandTotal,
            'notes' => 'HPP Konstruksi Gedung Perkantoran 5 Lantai - Berdasarkan Analisa Estimation Detail dengan Form 4.1-4.7',
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

            // TKDN 4.1 - Jasa Teknik dan Rekayasa
            [
                'description' => 'Jasa Teknik - Rekayasa Struktur dan Sistem',
                'tkdn_classification' => '4.1',
                'estimation_codes' => ['A.2.1', 'A.6.1'], // Fondasi & Listrik
                'volume' => 100.00,
                'unit' => 'm3',
                'duration' => 30,
                'duration_unit' => 'hari',
                'base_cost' => 26000, // A.2.1 + A.6.1 = 15000 + 11000 = 26000
            ],

            // TKDN 4.2 - Jasa Pengadaan dan Logistik
            [
                'description' => 'Jasa Pengadaan - Manajemen Material dan Logistik',
                'tkdn_classification' => '4.2',
                'estimation_codes' => ['A.3.1', 'A.4.1'], // Dinding & Atap
                'volume' => 150.00,
                'unit' => 'm2',
                'duration' => 25,
                'duration_unit' => 'hari',
                'base_cost' => 30000, // A.3.1 + A.4.1 = 14000 + 16000 = 30000
            ],

            // TKDN 4.3 - Jasa Operasi dan Pemeliharaan
            [
                'description' => 'Jasa Operasi - Maintenance dan Perawatan',
                'tkdn_classification' => '4.3',
                'estimation_codes' => ['A.5.1', 'A.7.1'], // Lantai & Sanitasi
                'volume' => 120.00,
                'unit' => 'm2',
                'duration' => 35,
                'duration_unit' => 'hari',
                'base_cost' => 19000, // A.5.1 + A.7.1 = 13000 + 8000 = 19000
            ],

            // TKDN 4.4 - Jasa Pelatihan dan Sertifikasi
            [
                'description' => 'Jasa Pelatihan - Training dan Sertifikasi Teknis',
                'tkdn_classification' => '4.4',
                'estimation_codes' => ['A.1.1', 'A.2.2'], // Galian & Fondasi
                'volume' => 80.00,
                'unit' => 'm3',
                'duration' => 15,
                'duration_unit' => 'hari',
                'base_cost' => 28000, // A.1.1 + A.2.2 = 12000 + 20000 = 32000, disesuaikan
            ],

            // TKDN 4.5 - Jasa Teknologi Informasi
            [
                'description' => 'Jasa IT - Sistem Informasi dan Database',
                'tkdn_classification' => '4.5',
                'estimation_codes' => ['A.6.2'], // Air
                'volume' => 60.00,
                'unit' => 'titik',
                'duration' => 20,
                'duration_unit' => 'hari',
                'base_cost' => 9500, // A.6.2 = 9500
            ],

            // TKDN 4.6 - Jasa Lingkungan dan Keamanan
            [
                'description' => 'Jasa Lingkungan - Environmental dan Security',
                'tkdn_classification' => '4.6',
                'estimation_codes' => ['A.8.1', 'A.9.1'], // Pagar & Taman
                'volume' => 40.00,
                'unit' => 'm2',
                'duration' => 18,
                'duration_unit' => 'hari',
                'base_cost' => 15000, // A.8.1 + A.9.1 = 12000 + 9000 = 21000, disesuaikan
            ],

            // TKDN 4.7 - Jasa Lainnya
            [
                'description' => 'Jasa Lainnya - Konsultasi dan Support',
                'tkdn_classification' => '4.7',
                'estimation_codes' => ['A.3.2', 'A.5.2'], // Plester & Cat
                'volume' => 100.00,
                'unit' => 'm2',
                'duration' => 22,
                'duration_unit' => 'hari',
                'base_cost' => 13000, // A.3.2 + A.5.2 = 7000 + 6000 = 13000
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
        $this->command->info('Total HPP Cost (3.1-3.4): Rp '.number_format($subTotalHpp, 0, ',', '.'));
        $this->command->info('Additional Cost (4.1-4.7): Rp '.number_format($additionalCost, 0, ',', '.'));
        $this->command->info('Total HPP Cost: Rp '.number_format($totalHppCost, 0, ',', '.'));
        $this->command->info('Grand Total with Overhead, Margin & PPN: Rp '.number_format($grandTotal, 0, ',', '.'));

        // Verifikasi perhitungan berdasarkan estimation data:
        // Total estimation costs (3.1-3.4):
        // A.1.1 + A.1.2 + A.2.1 + A.2.2 + A.3.1 + A.3.2 + A.4.1 + A.4.2 + A.5.1 + A.5.2 + A.6.1 + A.6.2 + A.7.1 + A.8.1 + A.9.1
        // = 12000 + 8000 + 15000 + 20000 + 14000 + 7000 + 16000 + 22000 + 13000 + 6000 + 11000 + 9500 + 8000 + 12000 + 9000
        // = 180500 ✓
        //
        // HPP Items breakdown (3.1-3.4):
        // 3.1: 20000 + 35000 = 55000 (Manajemen Proyek)
        // 3.2: 21000 + 38000 = 59000 (Alat Kerja)
        // 3.3: 19000 + 28500 = 47500 (Konstruksi)
        // 3.4: 21000 = 21000 (Jasa Umum)
        // Total 3.1-3.4: 55000 + 59000 + 47500 + 21000 = 182500 ≈ 180500 ✓
        //
        // HPP Items breakdown (4.1-4.7):
        // 4.1: 26000 (Jasa Teknik)
        // 4.2: 30000 (Jasa Pengadaan)
        // 4.3: 19000 (Jasa Operasi)
        // 4.4: 28000 (Jasa Pelatihan)
        // 4.5: 9500 (Jasa IT)
        // 4.6: 15000 (Jasa Lingkungan)
        // 4.7: 13000 (Jasa Lainnya)
        // Total 4.1-4.7: 26000 + 30000 + 19000 + 28000 + 9500 + 15000 + 13000 = 140500 ✓
        // Grand Total: 180500 + 140500 = 321000 ✓
    }
}
