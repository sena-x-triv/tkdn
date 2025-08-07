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
        Schema::create('tkdn_items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode item TKDN
            $table->string('name'); // Nama item/uraian barang/pekerjaan
            $table->string('tkdn_classification'); // Klasifikasi TKDN (3.1, 3.2, 3.3, 3.4)
            $table->string('unit'); // Satuan (Box, Bulan, dll)
            $table->decimal('unit_price', 15, 2); // Harga satuan
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkdn_items');
    }
};
