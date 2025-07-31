<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * MATERIAL
     */
    public function run(): void
    {
        // Get Material category ID
        $materialCategory = \App\Models\Category::where('code', 'MT')->first();
        $categoryId = $materialCategory ? $materialCategory->id : null;

        $materials = [
            ['code' => 'MT001', 'name' => 'Semen Mortar', 'specification' => 'Kemasan 30 Kg', 'category_id' => $categoryId, 'unit' => 'sak', 'price' => 60000, 'tkdn' => 49.03],
            ['code' => 'MT002', 'name' => 'Semen Mortar', 'specification' => 'Kemasan 40 Kg', 'category_id' => $categoryId, 'unit' => 'sak', 'price' => 65000, 'tkdn' => 87.03],
            ['code' => 'MT003', 'name' => 'Semen Portland Komposit', 'specification' => 'Portland Composite Cement (PCC), Kemasan 50 Kg', 'category_id' => $categoryId, 'unit' => 'sak', 'price' => 66400, 'tkdn' => 77.32],
            ['code' => 'MT004', 'name' => 'Semen Portland Komposit', 'specification' => 'Portland Composite Cement (PCC); Kemasan 40 Kg', 'category_id' => $categoryId, 'unit' => 'sak', 'price' => 49000, 'tkdn' => 82.27],
            ['code' => 'MT005', 'name' => 'Semen Portland Komposit', 'specification' => 'Kemasan 40 Kg', 'category_id' => $categoryId, 'unit' => 'sak', 'price' => 46000, 'tkdn' => 88.05],
            ['code' => 'MT006', 'name' => 'Cat Kayu dan Besi', 'specification' => 'Kemasan 900 ml', 'category_id' => $categoryId, 'unit' => 'klg', 'price' => 73000, 'tkdn' => 37.74],
            ['code' => 'MT007', 'name' => 'Cat Dasar (Under Coat) - Dulux Interior', 'specification' => 'Cat Dasar untuk interior berkualitas tinggi, berbahan dasar Resistance, Low Odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '25 kg', 'price' => 1145000, 'tkdn' => 60.56],
            ['code' => 'MT008', 'name' => 'Cat Dasar (Under Coat) – Dulux Catylac Eksterior', 'specification' => 'Cat Dasar Exterior untuk mengurangi serangan garam alkali dan meningkatkan daya rekat cat. Dilengkapi dengan fitur Peel Guard, Peeling Resistance, Low Odour & Low VOC.', 'category_id' => $categoryId, 'unit' => '21 kg', 'price' => 1025000, 'tkdn' => 70.28],
            ['code' => 'MT009', 'name' => 'Cat Dasar (Under Coat) - Dulux Catylac Interior', 'specification' => 'Cat Dasar Interior berbahan dasar air dilengkapi dengan fitur Peeling Resistance, Low Odour & Low VOC', 'category_id' => $categoryId, 'unit' => '21 kg', 'price' => 896000, 'tkdn' => 59.83],
            ['code' => 'MT010', 'name' => 'Cat Akhir (Top Coat) - Dulux Catylac Exterior', 'specification' => 'Cat eksterior berbahan dasar air. Dilengkapi dengan fitur Chroma Brite UV-Fight Formula, Algae-Fungus Resistance, High Opacity & Coverage, Low Odour & Low VOC.', 'category_id' => $categoryId, 'unit' => '25 kg', 'price' => 1119000, 'tkdn' => 39.65],
            ['code' => 'MT011', 'name' => 'Cat Akhir (Top Coat) - Dulux Catylac Interior', 'specification' => 'Dulux Interior berbahan dasar air. Dilengkapi dengan fitur Chroma Brite Formula, High Opacity & Coverage, Low Odour & Low VOC.', 'category_id' => $categoryId, 'unit' => '25 kg', 'price' => 811000, 'tkdn' => 17.13],
            ['code' => 'MT012', 'name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat interior berbahan dasar air dengan KidProof TechnologyTM* dilengkapi dengan anti-bakteri, Silver ION Technology yang memberikan manfaat Anti-Virus, High Opacity & Coverage, Low Odour & VOC.', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 1740000, 'tkdn' => 48.23],
            ['code' => 'MT013', 'name' => 'Cat Akhir (Top Coat) - Dulux Professional Interior', 'specification' => 'Cat interior berbahan dasar air. Dengan fitur Colour Guard, Anti Bakteri, Washable & Easy Cleaning, Low odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 1550000, 'tkdn' => 48.33],
            ['code' => 'MT014', 'name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat berbahan dasar air, dengan fitur Maxi-Coat membuat dinding menjadi tidak mudah mengapur, Maxi-Hide memaximalkan daya tutup, Maxi-Spread membuat daya sebar lebih maximal.', 'category_id' => $categoryId, 'unit' => '4,5 kg', 'price' => 72000, 'tkdn' => 48.97],
            ['code' => 'MT015', 'name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat interior berbahan dasar air dengan hasil akhir dilengkapi dengan fitur Anti-Bacterial, Colour Guard, Low Odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '2,5 ltr', 'price' => 283800, 'tkdn' => 31.42],
            ['code' => 'MT016', 'name' => 'Cat Akhir (Top Coat) - Dulux Eksterior', 'specification' => 'Cat eksterior berbahan dasar air, 100% Latex Acrylic dengan fitur Keep Cool Technology, Anti-Colour Fading Guard, Dirt & Dust Resistance Guard, Low Odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 2849000, 'tkdn' => 44.27],
            ['code' => 'MT017', 'name' => 'Cat Dasar (Under Coat) - Dulux Eksterior', 'specification' => 'Cat Dasar exterior berbahan dasar air. Dilengkapi dengan fitur Alkali Guard Damp Resist Technology, Peel Guard, Peeling Resistance, Low Odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 1270000, 'tkdn' => 58.42],
            ['code' => 'MT018', 'name' => 'Cat Akhir (Top Coat) – Dulux Eksterior', 'specification' => 'Cat eksterior berbahan dasar air yang menggabungkan cat dasar dan cat dinding menjadi satu. Dengan High Bond & Keep Cool Technology, Algae & Fungus Guard, Low Odour, Low VOC.', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 2747000, 'tkdn' => 49.54],
            ['code' => 'MT019', 'name' => 'Thinner', 'specification' => 'Pengencer Cat, Cairan', 'category_id' => $categoryId, 'unit' => '5 ltr', 'price' => 215200, 'tkdn' => 43.38],
            ['code' => 'MT020', 'name' => 'Cat', 'specification' => 'Cat Tembok Eksterior, Waterbased, Kapasitas 2,5 - 20 L', 'category_id' => $categoryId, 'unit' => '20 ltr', 'price' => 2269000, 'tkdn' => 32.83],
            ['code' => 'MT021', 'name' => 'Reng / Kaso Kayu', 'specification' => 'Kw Biasa Ukuran 3/4, 4/6, 5/7', 'category_id' => $categoryId, 'unit' => 'm3', 'price' => 2900000, 'tkdn' => 0.00],
            ['code' => 'MT022', 'name' => 'Balok Kayu', 'specification' => 'Kw Biasa Ukuran 5/7 5/10, 6/12, 8/12', 'category_id' => $categoryId, 'unit' => 'm3', 'price' => 3100000, 'tkdn' => 0.00],
            ['code' => 'MT023', 'name' => 'Papan Kayu', 'specification' => 'Kw Biasa Ukuran 2/20, 3/20', 'category_id' => $categoryId, 'unit' => 'm3', 'price' => 3000000, 'tkdn' => 0.00],
            ['code' => 'MT024', 'name' => 'Gypsum', 'specification' => '9 x 1200 x 2400 mm, tebal 7 mm dan 9 mm', 'category_id' => $categoryId, 'unit' => 'buah', 'price' => 79800, 'tkdn' => 30.34],
            ['code' => 'MT025', 'name' => 'Gypsum', 'specification' => '12 x 1200 x 2400 mm, tebal 7 mm dan 9 mm', 'category_id' => $categoryId, 'unit' => 'buah', 'price' => 105000, 'tkdn' => 29.43],
            ['code' => 'MT026', 'name' => 'Gypsum Compound', 'specification' => 'Cornice Adhesive, Skimcoat, Acian, Perekat Dinding & Stopping Compound', 'category_id' => $categoryId, 'unit' => 'sak (20 kg)', 'price' => 60000, 'tkdn' => 76.47],
            ['code' => 'MT027', 'name' => 'Gypsum Compound (Casting)', 'specification' => 'Standar & Premium', 'category_id' => $categoryId, 'unit' => 'sak (20 kg)', 'price' => 47000, 'tkdn' => 52.06],
            ['code' => 'MT028', 'name' => 'Papan Gypsum', 'specification' => 'Tebal: 9 & 12mm ; Lebar: 1200x2400mm, 1220x2440mm, 1220x1830mm', 'category_id' => $categoryId, 'unit' => 'lembar', 'price' => 54210, 'tkdn' => 46.65],
            ['code' => 'MT029', 'name' => 'Papan Gypsum Moisture (wr)', 'specification' => 'Indogyps WR ukuran 1200x2400: 1220x2440; tebal 9 & 12 mm', 'category_id' => $categoryId, 'unit' => 'buah', 'price' => 108000, 'tkdn' => 41.93],
            ['code' => 'MT030', 'name' => 'Papan Gypsum Akustik Tile', 'specification' => 'Gypsound 600x1200 ; 600x600 ; tebal 9 & 12 mm', 'category_id' => $categoryId, 'unit' => 'lembar', 'price' => 40000, 'tkdn' => 49.02],
            ['code' => 'MT031', 'name' => 'Papan Gypsum Akustik', 'specification' => 'Aplus Sound ukuran 1200x2400 & 1220x2440; tebal 9 & 12 mm', 'category_id' => $categoryId, 'unit' => 'lembar', 'price' => 360000, 'tkdn' => 51.40],
            ['code' => 'MT032', 'name' => 'Plaster Gypsum', 'specification' => 'Bahan untuk penutup sambungan papan gypsum, perekat papan gupsum, dan bahan untuk mencetak profil gypsum atau lembaran', 'category_id' => $categoryId, 'unit' => 'per kg', 'price' => 12000, 'tkdn' => 48.59]
        ];

        foreach ($materials as $material) {
            Material::firstOrCreate(['code' => $material['code']], $material);
        }
    }
}
 