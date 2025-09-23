<?php

use App\Helpers\StringHelper;
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
        // Konversi data string ke integer sebelum mengubah tipe kolom
        $this->convertStringToInt('workers');
        $this->convertStringToInt('material');
        $this->convertStringToInt('equipment');

        // Update workers table
        Schema::table('workers', function (Blueprint $table) {
            $table->integer('classification_tkdn')->nullable()->change();
        });

        // Update material table
        Schema::table('material', function (Blueprint $table) {
            $table->integer('classification_tkdn')->nullable()->change();
        });

        // Update equipment table
        Schema::table('equipment', function (Blueprint $table) {
            $table->integer('classification_tkdn')->nullable()->change();
        });
    }

    /**
     * Convert string classification to integer
     */
    private function convertStringToInt(string $table): void
    {
        $records = DB::table($table)
            ->whereNotNull('classification_tkdn')
            ->where('classification_tkdn', '!=', '')
            ->get();

        foreach ($records as $record) {
            $intValue = StringHelper::classificationTkdnToInt($record->classification_tkdn);

            if ($intValue !== null) {
                DB::table($table)
                    ->where('id', $record->id)
                    ->update(['classification_tkdn' => $intValue]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Konversi data integer ke string sebelum mengubah tipe kolom
        $this->convertIntToString('workers');
        $this->convertIntToString('material');
        $this->convertIntToString('equipment');

        // Revert workers table
        Schema::table('workers', function (Blueprint $table) {
            $table->string('classification_tkdn')->nullable()->change();
        });

        // Revert material table
        Schema::table('material', function (Blueprint $table) {
            $table->string('classification_tkdn')->nullable()->change();
        });

        // Revert equipment table
        Schema::table('equipment', function (Blueprint $table) {
            $table->string('classification_tkdn')->nullable()->change();
        });
    }

    /**
     * Convert integer classification to string
     */
    private function convertIntToString(string $table): void
    {
        $records = DB::table($table)
            ->whereNotNull('classification_tkdn')
            ->where('classification_tkdn', '!=', '')
            ->get();

        foreach ($records as $record) {
            $stringValue = StringHelper::intToClassificationTkdn((int) $record->classification_tkdn);

            if ($stringValue !== null) {
                DB::table($table)
                    ->where('id', $record->id)
                    ->update(['classification_tkdn' => $stringValue]);
            }
        }
    }
};
