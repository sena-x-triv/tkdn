<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('workers', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('unit');
            $table->unsignedBigInteger('price');
            $table->unsignedTinyInteger('tkdn')->default(100);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('workers');
    }
}; 