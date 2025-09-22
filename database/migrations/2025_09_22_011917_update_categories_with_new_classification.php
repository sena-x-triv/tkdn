<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom baru untuk mapping form ke kategori
        Schema::table('categories', function (Blueprint $table) {
            $table->string('form_mapping')->nullable()->after('tkdn_type');
        });

        // Update data kategori existing dengan mapping baru
        $this->updateExistingCategories();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('form_mapping');
        });
    }

    /**
     * Update existing categories with new classification mapping
     */
    private function updateExistingCategories(): void
    {
        // Mapping kategori baru sesuai permintaan
        $categoryMappings = [
            // Form 3.x (TKDN Jasa)
            '3.1' => [
                'name' => 'Overhead & Manajemen',
                'code' => 'OM',
                'tkdn_type' => 'tkdn_jasa',
                'form_mapping' => '3.1'
            ],
            '3.2' => [
                'name' => 'Alat / Fasilitas Kerja',
                'code' => 'AF',
                'tkdn_type' => 'tkdn_jasa', 
                'form_mapping' => '3.2'
            ],
            '3.3' => [
                'name' => 'Konstruksi Fabrikasi',
                'code' => 'KF',
                'tkdn_type' => 'tkdn_jasa',
                'form_mapping' => '3.3'
            ],
            '3.4' => [
                'name' => 'Peralatan (Jasa Umum)',
                'code' => 'PJ',
                'tkdn_type' => 'tkdn_jasa',
                'form_mapping' => '3.4'
            ],
            '3.5' => [
                'name' => 'Summary TKDN Jasa',
                'code' => 'S3',
                'tkdn_type' => 'tkdn_jasa',
                'form_mapping' => '3.5'
            ],
            
            // Form 4.x (TKDN Barang & Jasa)
            '4.1' => [
                'name' => 'Material (Bahan Baku)',
                'code' => 'MB',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.1'
            ],
            '4.2' => [
                'name' => 'Peralatan (Barang Jadi)',
                'code' => 'PB',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.2'
            ],
            '4.3' => [
                'name' => 'Overhead & Manajemen',
                'code' => 'OM4',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.3'
            ],
            '4.4' => [
                'name' => 'Alat / Fasilitas Kerja',
                'code' => 'AF4',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.4'
            ],
            '4.5' => [
                'name' => 'Konstruksi & Fabrikasi',
                'code' => 'KF4',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.5'
            ],
            '4.6' => [
                'name' => 'Peralatan (Jasa Umum)',
                'code' => 'PJ4',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.6'
            ],
            '4.7' => [
                'name' => 'Summary TKDN Barang & Jasa',
                'code' => 'S4',
                'tkdn_type' => 'tkdn_barang_jasa',
                'form_mapping' => '4.7'
            ]
        ];

        // Insert atau update kategori baru
        foreach ($categoryMappings as $formCode => $categoryData) {
            \App\Models\Category::updateOrCreate(
                ['code' => $categoryData['code']],
                $categoryData
            );
        }
    }
};
