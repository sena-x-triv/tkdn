<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update Material table - convert to new classification names (without form numbers)
        DB::table('material')->where('classification_tkdn', '3.1 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('material')->where('classification_tkdn', '3.2 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('material')->where('classification_tkdn', '3.3 - Konstruksi Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('material')->where('classification_tkdn', '3.4 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('material')->where('classification_tkdn', '3.5 - Summary')
            ->update(['classification_tkdn' => 'Summary']);
        
        DB::table('material')->where('classification_tkdn', '4.1 - Material (Bahan Baku)')
            ->update(['classification_tkdn' => 'Material (Bahan Baku)']);
        
        DB::table('material')->where('classification_tkdn', '4.2 - Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => 'Peralatan (Barang Jadi)']);
        
        DB::table('material')->where('classification_tkdn', '4.3 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('material')->where('classification_tkdn', '4.4 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('material')->where('classification_tkdn', '4.5 - Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('material')->where('classification_tkdn', '4.6 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('material')->where('classification_tkdn', '4.7 - Summary')
            ->update(['classification_tkdn' => 'Summary']);

        // Update Workers table - convert to new classification names (without form numbers)
        DB::table('workers')->where('classification_tkdn', '3.1 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('workers')->where('classification_tkdn', '3.2 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('workers')->where('classification_tkdn', '3.3 - Konstruksi Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('workers')->where('classification_tkdn', '3.4 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('workers')->where('classification_tkdn', '3.5 - Summary')
            ->update(['classification_tkdn' => 'Summary']);
        
        DB::table('workers')->where('classification_tkdn', '4.1 - Material (Bahan Baku)')
            ->update(['classification_tkdn' => 'Material (Bahan Baku)']);
        
        DB::table('workers')->where('classification_tkdn', '4.2 - Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => 'Peralatan (Barang Jadi)']);
        
        DB::table('workers')->where('classification_tkdn', '4.3 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('workers')->where('classification_tkdn', '4.4 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('workers')->where('classification_tkdn', '4.5 - Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('workers')->where('classification_tkdn', '4.6 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('workers')->where('classification_tkdn', '4.7 - Summary')
            ->update(['classification_tkdn' => 'Summary']);

        // Update Equipment table - convert to new classification names (without form numbers)
        DB::table('equipment')->where('classification_tkdn', '3.1 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('equipment')->where('classification_tkdn', '3.2 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('equipment')->where('classification_tkdn', '3.3 - Konstruksi Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('equipment')->where('classification_tkdn', '3.4 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('equipment')->where('classification_tkdn', '3.5 - Summary')
            ->update(['classification_tkdn' => 'Summary']);
        
        DB::table('equipment')->where('classification_tkdn', '4.1 - Material (Bahan Baku)')
            ->update(['classification_tkdn' => 'Material (Bahan Baku)']);
        
        DB::table('equipment')->where('classification_tkdn', '4.2 - Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => 'Peralatan (Barang Jadi)']);
        
        DB::table('equipment')->where('classification_tkdn', '4.3 - Overhead & Manajemen')
            ->update(['classification_tkdn' => 'Overhead & Manajemen']);
        
        DB::table('equipment')->where('classification_tkdn', '4.4 - Alat / Fasilitas Kerja')
            ->update(['classification_tkdn' => 'Alat Kerja / Fasilitas']);
        
        DB::table('equipment')->where('classification_tkdn', '4.5 - Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => 'Konstruksi & Fabrikasi']);
        
        DB::table('equipment')->where('classification_tkdn', '4.6 - Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => 'Peralatan (Jasa Umum)']);
        
        DB::table('equipment')->where('classification_tkdn', '4.7 - Summary')
            ->update(['classification_tkdn' => 'Summary']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse Material table
        DB::table('material')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '3.1 - Overhead & Manajemen']);
        
        DB::table('material')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '3.2 - Alat / Fasilitas Kerja']);
        
        DB::table('material')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '3.3 - Konstruksi Fabrikasi']);
        
        DB::table('material')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '3.4 - Peralatan (Jasa Umum)']);
        
        DB::table('material')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '3.5 - Summary']);
        
        DB::table('material')->where('classification_tkdn', 'Material (Bahan Baku)')
            ->update(['classification_tkdn' => '4.1 - Material (Bahan Baku)']);
        
        DB::table('material')->where('classification_tkdn', 'Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => '4.2 - Peralatan (Barang Jadi)']);
        
        DB::table('material')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '4.3 - Overhead & Manajemen']);
        
        DB::table('material')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '4.4 - Alat / Fasilitas Kerja']);
        
        DB::table('material')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '4.5 - Konstruksi & Fabrikasi']);
        
        DB::table('material')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '4.6 - Peralatan (Jasa Umum)']);
        
        DB::table('material')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '4.7 - Summary']);

        // Reverse Workers table
        DB::table('workers')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '3.1 - Overhead & Manajemen']);
        
        DB::table('workers')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '3.2 - Alat / Fasilitas Kerja']);
        
        DB::table('workers')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '3.3 - Konstruksi Fabrikasi']);
        
        DB::table('workers')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '3.4 - Peralatan (Jasa Umum)']);
        
        DB::table('workers')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '3.5 - Summary']);
        
        DB::table('workers')->where('classification_tkdn', 'Material (Bahan Baku)')
            ->update(['classification_tkdn' => '4.1 - Material (Bahan Baku)']);
        
        DB::table('workers')->where('classification_tkdn', 'Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => '4.2 - Peralatan (Barang Jadi)']);
        
        DB::table('workers')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '4.3 - Overhead & Manajemen']);
        
        DB::table('workers')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '4.4 - Alat / Fasilitas Kerja']);
        
        DB::table('workers')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '4.5 - Konstruksi & Fabrikasi']);
        
        DB::table('workers')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '4.6 - Peralatan (Jasa Umum)']);
        
        DB::table('workers')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '4.7 - Summary']);

        // Reverse Equipment table
        DB::table('equipment')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '3.1 - Overhead & Manajemen']);
        
        DB::table('equipment')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '3.2 - Alat / Fasilitas Kerja']);
        
        DB::table('equipment')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '3.3 - Konstruksi Fabrikasi']);
        
        DB::table('equipment')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '3.4 - Peralatan (Jasa Umum)']);
        
        DB::table('equipment')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '3.5 - Summary']);
        
        DB::table('equipment')->where('classification_tkdn', 'Material (Bahan Baku)')
            ->update(['classification_tkdn' => '4.1 - Material (Bahan Baku)']);
        
        DB::table('equipment')->where('classification_tkdn', 'Peralatan (Barang Jadi)')
            ->update(['classification_tkdn' => '4.2 - Peralatan (Barang Jadi)']);
        
        DB::table('equipment')->where('classification_tkdn', 'Overhead & Manajemen')
            ->update(['classification_tkdn' => '4.3 - Overhead & Manajemen']);
        
        DB::table('equipment')->where('classification_tkdn', 'Alat Kerja / Fasilitas')
            ->update(['classification_tkdn' => '4.4 - Alat / Fasilitas Kerja']);
        
        DB::table('equipment')->where('classification_tkdn', 'Konstruksi & Fabrikasi')
            ->update(['classification_tkdn' => '4.5 - Konstruksi & Fabrikasi']);
        
        DB::table('equipment')->where('classification_tkdn', 'Peralatan (Jasa Umum)')
            ->update(['classification_tkdn' => '4.6 - Peralatan (Jasa Umum)']);
        
        DB::table('equipment')->where('classification_tkdn', 'Summary')
            ->update(['classification_tkdn' => '4.7 - Summary']);
    }
};