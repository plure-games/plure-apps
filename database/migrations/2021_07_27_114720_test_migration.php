<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'test',
            function (Blueprint $table) {
                $table->bigIncrements('id');
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('test');
    }
}
