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
        $materials = [
            ['name' => 'Semen Mortar', 'specification' => 'Kemasan 30 Kg', 'unit' => 'sak', 'price' => 60000, 'tkdn' => 49.03],
            ['name' => 'Semen Mortar', 'specification' => 'Kemasan 40 Kg', 'unit' => 'sak', 'price' => 65000, 'tkdn' => 87.03],
            ['name' => 'Semen Portland Komposit', 'specification' => 'Portland Composite Cement (PCC), Kemasan 50 Kg', 'unit' => 'sak', 'price' => 66400, 'tkdn' => 77.32],
            ['name' => 'Semen Portland Komposit', 'specification' => 'Portland Composite Cement (PCC); Kemasan 40 Kg', 'unit' => 'sak', 'price' => 49000, 'tkdn' => 82.27],
            ['name' => 'Semen Portland Komposit', 'specification' => 'Kemasan 40 Kg', 'unit' => 'sak', 'price' => 46000, 'tkdn' => 88.05],
            ['name' => 'Cat Kayu dan Besi', 'specification' => 'Kemasan 900 ml', 'unit' => 'klg', 'price' => 73000, 'tkdn' => 37.74],
            ['name' => 'Cat Dasar (Under Coat) - Dulux Interior', 'specification' => 'Cat Dasar untuk interior berkualitas tinggi, berbahan dasar Resistance, Low Odour, Low VOC.', 'unit' => '25 kg', 'price' => 1145000, 'tkdn' => 60.56],
            ['name' => 'Cat Dasar (Under Coat) – Dulux Catylac Eksterior', 'specification' => 'Cat Dasar Exterior untuk mengurangi serangan garam alkali dan meningkatkan daya rekat cat. Dilengkapi dengan fitur Peel Guard, Peeling Resistance, Low Odour & Low VOC.', 'unit' => '21 kg', 'price' => 1025000, 'tkdn' => 70.28],
            ['name' => 'Cat Dasar (Under Coat) - Dulux Catylac Interior', 'specification' => 'Cat Dasar Interior berbahan dasar air dilengkapi dengan fitur Peeling Resistance, Low Odour & Low VOC', 'unit' => '21 kg', 'price' => 896000, 'tkdn' => 59.83],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Catylac Exterior', 'specification' => 'Cat eksterior berbahan dasar air. Dilengkapi dengan fitur Chroma Brite UV-Fight Formula, Algae-Fungus Resistance, High Opacity & Coverage, Low Odour & Low VOC.', 'unit' => '25 kg', 'price' => 1119000, 'tkdn' => 39.65],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Catylac Interior', 'specification' => 'Dulux Interior berbahan dasar air. Dilengkapi dengan fitur Chroma Brite Formula, High Opacity & Coverage, Low Odour & Low VOC.', 'unit' => '25 kg', 'price' => 811000, 'tkdn' => 17.13],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat interior berbahan dasar air dengan KidProof TechnologyTM* dilengkapi dengan anti-bakteri, Silver ION Technology yang memberikan manfaat Anti-Virus, High Opacity & Coverage, Low Odour & VOC.', 'unit' => '20 ltr', 'price' => 1740000, 'tkdn' => 48.23],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Professional Interior', 'specification' => 'Cat interior berbahan dasar air. Dengan fitur Colour Guard, Anti Bakteri, Washable & Easy Cleaning, Low odour, Low VOC.', 'unit' => '20 ltr', 'price' => 1550000, 'tkdn' => 48.33],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat berbahan dasar air, dengan fitur Maxi-Coat membuat dinding menjadi tidak mudah mengapur, Maxi-Hide memaximalkan daya tutup, Maxi-Spread membuat daya sebar lebih maximal.', 'unit' => '4,5 kg', 'price' => 72000, 'tkdn' => 48.97],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Interior', 'specification' => 'Cat interior berbahan dasar air dengan hasil akhir dilengkapi dengan fitur Anti-Bacterial, Colour Guard, Low Odour, Low VOC.', 'unit' => '2,5 ltr', 'price' => 283800, 'tkdn' => 31.42],
            ['name' => 'Cat Akhir (Top Coat) - Dulux Eksterior', 'specification' => 'Cat eksterior berbahan dasar air, 100% Latex Acrylic dengan fitur Keep Cool Technology, Anti-Colour Fading Guard, Dirt & Dust Resistance Guard, Low Odour, Low VOC.', 'unit' => '20 ltr', 'price' => 2849000, 'tkdn' => 44.27],
            ['name' => 'Cat Dasar (Under Coat) - Dulux Eksterior', 'specification' => 'Cat Dasar exterior berbahan dasar air. Dilengkapi dengan fitur Alkali Guard Damp Resist Technology, Peel Guard, Peeling Resistance, Low Odour, Low VOC.', 'unit' => '20 ltr', 'price' => 1270000, 'tkdn' => 58.42],
            ['name' => 'Cat Akhir (Top Coat) – Dulux Eksterior', 'specification' => 'Cat eksterior berbahan dasar air yang menggabungkan cat dasar dan cat dinding menjadi satu. Dengan High Bond & Keep Cool Technology, Algae & Fungus Guard, Low Odour, Low VOC.', 'unit' => '20 ltr', 'price' => 2747000, 'tkdn' => 49.54],
            ['name' => 'Thinner', 'specification' => 'Pengencer Cat, Cairan', 'unit' => '5 ltr', 'price' => 215200, 'tkdn' => 43.38],
            ['name' => 'Cat', 'specification' => 'Cat Tembok Eksterior, Waterbased, Kapasitas 2,5 - 20 L', 'unit' => '20 ltr', 'price' => 2269000, 'tkdn' => 32.83],
            ['name' => 'Reng / Kaso Kayu', 'specification' => 'Kw Biasa Ukuran 3/4, 4/6, 5/7', 'unit' => 'm3', 'price' => 2900000, 'tkdn' => 0.00],
            ['name' => 'Balok Kayu', 'specification' => 'Kw Biasa Ukuran 5/7 5/10, 6/12, 8/12', 'unit' => 'm3', 'price' => 3100000, 'tkdn' => 0.00],
            ['name' => 'Papan Kayu', 'specification' => 'Kw Biasa Ukuran 2/20, 3/20', 'unit' => 'm3', 'price' => 3000000, 'tkdn' => 0.00],
            ['name' => 'Gypsum', 'specification' => '9 x 1200 x 2400 mm, tebal 7 mm dan 9 mm', 'unit' => 'buah', 'price' => 79800, 'tkdn' => 30.34],
            ['name' => 'Gypsum', 'specification' => '12 x 1200 x 2400 mm, tebal 7 mm dan 9 mm', 'unit' => 'buah', 'price' => 105000, 'tkdn' => 29.43],
            ['name' => 'Gypsum Compound', 'specification' => 'Cornice Adhesive, Skimcoat, Acian, Perekat Dinding & Stopping Compound', 'unit' => 'sak (20 kg)', 'price' => 60000, 'tkdn' => 76.47],
            ['name' => 'Gypsum Compound (Casting)', 'specification' => 'Standar & Premium', 'unit' => 'sak (20 kg)', 'price' => 47000, 'tkdn' => 52.06],
            ['name' => 'Papan Gypsum', 'specification' => 'Tebal: 9 & 12mm ; Lebar: 1200x2400mm, 1220x2440mm, 1220x1830mm', 'unit' => 'lembar', 'price' => 54210, 'tkdn' => 46.65],
            ['name' => 'Papan Gypsum Moisture (wr)', 'specification' => 'Indogyps WR ukuran 1200x2400: 1220x2440; tebal 9 & 12 mm', 'unit' => 'buah', 'price' => 108000, 'tkdn' => 41.93],
            ['name' => 'Papan Gypsum Akustik Tile', 'specification' => 'Gypsound 600x1200 ; 600x600 ; tebal 9 & 12 mm', 'unit' => 'lembar', 'price' => 40000, 'tkdn' => 49.02],
            ['name' => 'Papan Gypsum Akustik', 'specification' => 'Aplus Sound ukuran 1200x2400 & 1220x2440; tebal 9 & 12 mm', 'unit' => 'lembar', 'price' => 360000, 'tkdn' => 51.40],
            ['name' => 'Plaster Gypsum', 'specification' => 'Bahan untuk penutup sambungan papan gypsum, perekat papan gupsum, dan bahan untuk mencetak profil gypsum atau lembaran', 'unit' => 'per kg', 'price' => 12000, 'tkdn' => 48.59]
        ];


        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
 