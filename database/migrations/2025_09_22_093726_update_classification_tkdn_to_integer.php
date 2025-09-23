<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define mapping from string classification names to integer codes
        $classificationMappings = [
            'Overhead & Manajemen' => 1,
            'Alat Kerja / Fasilitas' => 2,
            'Konstruksi & Fabrikasi' => 3,
            'Peralatan (Jasa Umum)' => 4,
            'Material (Bahan Baku)' => 5,
            'Peralatan (Barang Jadi)' => 6,
            'Summary' => 7, // For any remaining summary entries
        ];

        // Update all tables with classification mappings
        $tables = ['material', 'workers', 'equipment'];

        foreach ($tables as $table) {
            // First, add a temporary column to store the integer values
            Schema::table($table, function (Blueprint $table) {
                $table->integer('classification_tkdn_temp')->nullable()->after('classification_tkdn');
            });

            // Update the temporary column with integer values
            foreach ($classificationMappings as $stringValue => $intValue) {
                DB::table($table)
                    ->where('classification_tkdn', $stringValue)
                    ->update(['classification_tkdn_temp' => $intValue]);
            }

            // Handle any remaining values that don't match our mappings
            // Set them to 0 (unknown/invalid)
            DB::table($table)
                ->whereNull('classification_tkdn_temp')
                ->whereNotNull('classification_tkdn')
                ->update(['classification_tkdn_temp' => 0]);

            // Drop the old column
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('classification_tkdn');
            });

            // Rename the temporary column to the original name
            Schema::table($table, function (Blueprint $table) {
                $table->renameColumn('classification_tkdn_temp', 'classification_tkdn');
            });

            // Add constraints
            Schema::table($table, function (Blueprint $table) {
                $table->integer('classification_tkdn')->nullable(false)->change();
                $table->index('classification_tkdn');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Define reverse mapping from integer codes back to string names
        $reverseMappings = [
            1 => 'Overhead & Manajemen',
            2 => 'Alat Kerja / Fasilitas',
            3 => 'Konstruksi & Fabrikasi',
            4 => 'Peralatan (Jasa Umum)',
            5 => 'Material (Bahan Baku)',
            6 => 'Peralatan (Barang Jadi)',
            7 => 'Summary',
        ];

        $tables = ['material', 'workers', 'equipment'];

        foreach ($tables as $table) {
            // First, add a temporary column to store the string values
            Schema::table($table, function (Blueprint $table) {
                $table->string('classification_tkdn_temp')->nullable()->after('classification_tkdn');
            });

            // Update the temporary column with string values
            foreach ($reverseMappings as $intValue => $stringValue) {
                DB::table($table)
                    ->where('classification_tkdn', $intValue)
                    ->update(['classification_tkdn_temp' => $stringValue]);
            }

            // Handle any remaining values (set to 'Unknown')
            DB::table($table)
                ->whereNull('classification_tkdn_temp')
                ->whereNotNull('classification_tkdn')
                ->update(['classification_tkdn_temp' => 'Unknown']);

            // Drop the old column
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('classification_tkdn');
            });

            // Rename the temporary column to the original name
            Schema::table($table, function (Blueprint $table) {
                $table->renameColumn('classification_tkdn_temp', 'classification_tkdn');
            });

            // Add constraints
            Schema::table($table, function (Blueprint $table) {
                $table->string('classification_tkdn')->nullable(false)->change();
            });
        }
    }
};
