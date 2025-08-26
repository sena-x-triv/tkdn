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
        Schema::table('estimation_items', function (Blueprint $table) {
            $table->string('tkdn_classification')->nullable()->after('total_price');
            $table->decimal('tkdn_value', 5, 2)->nullable()->after('tkdn_classification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estimation_items', function (Blueprint $table) {
            $table->dropColumn(['tkdn_classification', 'tkdn_value']);
        });
    }
};
