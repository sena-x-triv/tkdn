<?php

namespace Database\Seeders;

use App\Models\Estimation;
use Illuminate\Database\Seeder;

class EstimationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estimations = [
            [
                'code' => 'A.1.1',
                'title' => 'Pekerjaan Galian Tanah',
                'total' => 12000, // Biaya dasar
                'margin' => 15, // 15% margin
                'total_unit_price' => 13800, // 12000 + (12000 x 15%) = 12000 + 1800 = 13800
            ],
            [
                'code' => 'A.1.2',
                'title' => 'Pekerjaan Urugan Tanah',
                'total' => 8000, // Biaya dasar
                'margin' => 12, // 12% margin
                'total_unit_price' => 8960, // 8000 + (8000 x 12%) = 8000 + 960 = 8960
            ],
            [
                'code' => 'A.2.1',
                'title' => 'Pekerjaan Fondasi Batu Kali',
                'total' => 15000, // Biaya dasar
                'margin' => 18, // 18% margin
                'total_unit_price' => 17700, // 15000 + (15000 x 18%) = 15000 + 2700 = 17700
            ],
            [
                'code' => 'A.2.2',
                'title' => 'Pekerjaan Fondasi Beton',
                'total' => 20000, // Biaya dasar
                'margin' => 20, // 20% margin
                'total_unit_price' => 24000, // 20000 + (20000 x 20%) = 20000 + 4000 = 24000
            ],
            [
                'code' => 'A.3.1',
                'title' => 'Pekerjaan Dinding Bata',
                'total' => 14000, // Biaya dasar
                'margin' => 16, // 16% margin
                'total_unit_price' => 16240, // 14000 + (14000 x 16%) = 14000 + 2240 = 16240
            ],
            [
                'code' => 'A.3.2',
                'title' => 'Pekerjaan Plesteran',
                'total' => 7000, // Biaya dasar
                'margin' => 14, // 14% margin
                'total_unit_price' => 7980, // 7000 + (7000 x 14%) = 7000 + 980 = 7980
            ],
            [
                'code' => 'A.4.1',
                'title' => 'Pekerjaan Atap',
                'total' => 16000, // Biaya dasar
                'margin' => 17, // 17% margin
                'total_unit_price' => 18720, // 16000 + (16000 x 17%) = 16000 + 2720 = 18720
            ],
            [
                'code' => 'A.4.2',
                'title' => 'Pekerjaan Kusen Kayu',
                'total' => 22000, // Biaya dasar
                'margin' => 22, // 22% margin
                'total_unit_price' => 26840, // 22000 + (22000 x 22%) = 22000 + 4840 = 26840
            ],
            [
                'code' => 'A.5.1',
                'title' => 'Pekerjaan Lantai Keramik',
                'total' => 13000, // Biaya dasar
                'margin' => 19, // 19% margin
                'total_unit_price' => 15470, // 13000 + (13000 x 19%) = 13000 + 2470 = 15470
            ],
            [
                'code' => 'A.5.2',
                'title' => 'Pekerjaan Cat Tembok',
                'total' => 6000, // Biaya dasar
                'margin' => 13, // 13% margin
                'total_unit_price' => 6780, // 6000 + (6000 x 13%) = 6000 + 780 = 6780
            ],
            [
                'code' => 'A.6.1',
                'title' => 'Pekerjaan Instalasi Listrik',
                'total' => 11000, // Biaya dasar
                'margin' => 21, // 21% margin
                'total_unit_price' => 13310, // 11000 + (11000 x 21%) = 11000 + 2310 = 13310
            ],
            [
                'code' => 'A.6.2',
                'title' => 'Pekerjaan Instalasi Air',
                'total' => 9500, // Biaya dasar
                'margin' => 16, // 16% margin
                'total_unit_price' => 11020, // 9500 + (9500 x 16%) = 9500 + 1520 = 11020
            ],
            [
                'code' => 'A.7.1',
                'title' => 'Pekerjaan Sanitasi',
                'total' => 8000, // Biaya dasar
                'margin' => 15, // 15% margin
                'total_unit_price' => 9200, // 8000 + (8000 x 15%) = 8000 + 1200 = 9200
            ],
            [
                'code' => 'A.8.1',
                'title' => 'Pekerjaan Pagar',
                'total' => 12000, // Biaya dasar
                'margin' => 18, // 18% margin
                'total_unit_price' => 14160, // 12000 + (12000 x 18%) = 12000 + 2160 = 14160
            ],
            [
                'code' => 'A.9.1',
                'title' => 'Pekerjaan Taman',
                'total' => 9000, // Biaya dasar
                'margin' => 20, // 20% margin
                'total_unit_price' => 10800, // 9000 + (9000 x 20%) = 9000 + 1800 = 10800
            ],
        ];

        foreach ($estimations as $estimation) {
            Estimation::create($estimation);
        }

        // Verifikasi perhitungan:
        // Total biaya dasar: 12000 + 8000 + 15000 + 20000 + 14000 + 7000 + 16000 + 22000 + 13000 + 6000 + 11000 + 9500 + 8000 + 12000 + 9000 = 180500
        // Total dengan margin: 13800 + 8960 + 17700 + 24000 + 16240 + 7980 + 18720 + 26840 + 15470 + 6780 + 13310 + 11020 + 9200 + 14160 + 10800 = 217980
    }
}
