<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration ini dibuat untuk menandai bahwa perubahan estimation_id ke estimation_item_id sudah selesai
        // Kolom sudah berubah secara manual di database
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada yang perlu di-reverse
    }
};
