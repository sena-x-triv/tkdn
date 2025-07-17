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
                'total' => 125000,
                'margin' => 15,
                'total_unit_price' => 143750
            ],
            [
                'code' => 'A.1.2',
                'title' => 'Pekerjaan Urugan Tanah',
                'total' => 98000,
                'margin' => 12,
                'total_unit_price' => 109760
            ],
            [
                'code' => 'A.2.1',
                'title' => 'Pekerjaan Fondasi Batu Kali',
                'total' => 185000,
                'margin' => 18,
                'total_unit_price' => 218300
            ],
            [
                'code' => 'A.2.2',
                'title' => 'Pekerjaan Fondasi Beton',
                'total' => 245000,
                'margin' => 20,
                'total_unit_price' => 294000
            ],
            [
                'code' => 'A.3.1',
                'title' => 'Pekerjaan Dinding Bata',
                'total' => 165000,
                'margin' => 16,
                'total_unit_price' => 191400
            ],
            [
                'code' => 'A.3.2',
                'title' => 'Pekerjaan Plesteran',
                'total' => 85000,
                'margin' => 14,
                'total_unit_price' => 96900
            ],
            [
                'code' => 'A.4.1',
                'title' => 'Pekerjaan Atap',
                'total' => 195000,
                'margin' => 17,
                'total_unit_price' => 228150
            ],
            [
                'code' => 'A.4.2',
                'title' => 'Pekerjaan Kusen Kayu',
                'total' => 275000,
                'margin' => 22,
                'total_unit_price' => 335500
            ],
            [
                'code' => 'A.5.1',
                'title' => 'Pekerjaan Lantai Keramik',
                'total' => 155000,
                'margin' => 19,
                'total_unit_price' => 184450
            ],
            [
                'code' => 'A.5.2',
                'title' => 'Pekerjaan Cat Tembok',
                'total' => 75000,
                'margin' => 13,
                'total_unit_price' => 84750
            ],
            [
                'code' => 'A.6.1',
                'title' => 'Pekerjaan Instalasi Listrik',
                'total' => 135000,
                'margin' => 21,
                'total_unit_price' => 163350
            ],
            [
                'code' => 'A.6.2',
                'title' => 'Pekerjaan Instalasi Air',
                'total' => 115000,
                'margin' => 16,
                'total_unit_price' => 133400
            ],
            [
                'code' => 'A.7.1',
                'title' => 'Pekerjaan Sanitasi',
                'total' => 95000,
                'margin' => 15,
                'total_unit_price' => 109250
            ],
            [
                'code' => 'A.8.1',
                'title' => 'Pekerjaan Pagar',
                'total' => 145000,
                'margin' => 18,
                'total_unit_price' => 171100
            ],
            [
                'code' => 'A.9.1',
                'title' => 'Pekerjaan Taman',
                'total' => 105000,
                'margin' => 20,
                'total_unit_price' => 126000
            ],
        ];

        foreach ($estimations as $estimation) {
            Estimation::create($estimation);
        }
    }
}
 