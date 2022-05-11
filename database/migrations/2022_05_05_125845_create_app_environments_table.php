<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppEnvironmentsTable extends Migration
{
    public function up()
    {
        Schema::create('app_environments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('app_id');
            $table->string('key');
            $table->string('value');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_environments');
    }
}
