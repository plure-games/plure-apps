<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestMigration extends Migration
{
    public function up()
    {
        Schema::create(
            'testw',
            function (Blueprint $table) {
                $table->bigIncrements('id');
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('testw');
    }
}
