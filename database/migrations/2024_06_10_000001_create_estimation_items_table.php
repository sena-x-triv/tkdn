<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('estimation_items', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            $table->id();
            $table->ulid('estimation_id');
            $table->foreign('estimation_id')->references('id')->on('estimations')->onDelete('cascade');
            $table->enum('category', ['worker', 'material', 'equipment']); // jenis input
            $table->ulid('reference_id')->nullable(); // id dari tabel worker/material
            $table->string('equipment_name')->nullable(); // hanya untuk equipment
            $table->string('code')->nullable();
            $table->decimal('coefficient', 10, 3)->default(0);
            $table->unsignedBigInteger('unit_price')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->timestamps();
            $table->index(['category', 'reference_id']);
        });
    }
    public function down() {
        Schema::dropIfExists('estimation_items');
    }
}; 