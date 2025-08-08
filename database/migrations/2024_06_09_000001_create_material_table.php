<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('material', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            $table->ulid('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('specification')->nullable();
            $table->ulid('category_id')->nullable();

            $table->string('brand')->nullable();
            $table->unsignedTinyInteger('tkdn')->default(100);
            $table->unsignedBigInteger('price')->nullable();
            $table->string('unit')->nullable();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('price_inflasi')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('material');
    }
}; 