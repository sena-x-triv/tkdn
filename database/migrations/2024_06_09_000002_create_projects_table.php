<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('projects', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->ulid('id')->primary();
            $table->string('name');
            $table->enum('status', ['draft', 'on_progress', 'completed'])->default('draft');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('projects');
    }
}; 