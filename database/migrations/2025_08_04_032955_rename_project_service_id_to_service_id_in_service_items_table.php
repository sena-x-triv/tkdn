<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->renameColumn('project_service_id', 'service_id');
        });
    }

    public function down()
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->renameColumn('service_id', 'project_service_id');
        });
    }
};
