<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAppEnvironmentsValueLength extends Migration
{
    public function up()
    {
        Schema::table('app_environments', function (Blueprint $table) {
            $table->text('value')->change();
        });
    }

    public function down()
    {
        Schema::table('app_environments', function (Blueprint $table) {
            $table->string('value')->change();
        });
    }
}
