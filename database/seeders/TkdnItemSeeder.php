<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TkdnItem;

class TkdnItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tkdnItems = [
            [
                'code' => 'A.6.3.3.1',
                'name' => 'Penerimaan dan Pengangkutan Arsip Per Box Standard',
                'tkdn_classification' => '3.1',
                'unit' => 'Box',
                'unit_price' => 77325.00,
                'description' => 'Layanan penerimaan dan pengangkutan arsip per box standard',
                'is_active' => true,
            ],
            [
                'code' => 'A.6.3.4.1',
                'name' => 'Pemilahan dan Update Database Arsip Per Box Standard',
                'tkdn_classification' => '3.2',
                'unit' => 'Box',
                'unit_price' => 66425.00,
                'description' => 'Layanan pemilahan dan update database arsip per box standard',
                'is_active' => true,
            ],
            [
                'code' => 'A.6.3.2.1',
                'name' => 'Penyimpanan Arsip Per Box Standart',
                'tkdn_classification' => '3.3',
                'unit' => 'Box',
                'unit_price' => 35975.83,
                'description' => 'Layanan penyimpanan arsip per box standard',
                'is_active' => true,
            ],
            [
                'code' => 'A.6.3.1.1',
                'name' => 'Penataan Arsip Per Box Arsip Standart',
                'tkdn_classification' => '3.4',
                'unit' => 'Box',
                'unit_price' => 44758.33,
                'description' => 'Layanan penataan arsip per box arsip standard',
                'is_active' => true,
            ],
        ];

        foreach ($tkdnItems as $item) {
            TkdnItem::create($item);
        }

        $this->command->info('TKDN Items seeded successfully!');
    }
}
