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
        // First, add a temporary column to store the integer values
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->integer('tkdn_classification_temp')->nullable()->after('tkdn_classification');
        });

        // Update the temporary column with integer values from tkdn_classification
        DB::table('hpp_items')
            ->whereNotNull('tkdn_classification')
            ->where('tkdn_classification', '!=', '')
            ->update(['tkdn_classification_temp' => DB::raw('CAST(tkdn_classification AS UNSIGNED)')]);

        // Drop the old column
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->dropColumn('tkdn_classification');
        });

        // Rename the temporary column to the original name
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->renameColumn('tkdn_classification_temp', 'tkdn_classification');
        });

        // Add constraints
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->integer('tkdn_classification')->nullable()->change();
            $table->index('tkdn_classification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert integer back to string
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->string('tkdn_classification_temp')->nullable()->after('tkdn_classification');
        });

        // Update the temporary column with string values
        DB::table('hpp_items')
            ->whereNotNull('tkdn_classification')
            ->update(['tkdn_classification_temp' => DB::raw('CAST(tkdn_classification AS CHAR)')]);

        // Drop the old column
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->dropColumn('tkdn_classification');
        });

        // Rename the temporary column to the original name
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->renameColumn('tkdn_classification_temp', 'tkdn_classification');
        });

        // Add constraints
        Schema::table('hpp_items', function (Blueprint $table) {
            $table->string('tkdn_classification')->nullable()->change();
        });
    }
};
