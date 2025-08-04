<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('project_service_items', 'service_items');
    }

    public function down()
    {
        Schema::rename('service_items', 'project_service_items');
    }
};
