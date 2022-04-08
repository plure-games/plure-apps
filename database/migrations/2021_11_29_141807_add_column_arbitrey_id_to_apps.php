<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnArbitreyIdToApps extends Migration
{
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->unsignedBigInteger('arbitrey_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn('arbitrey_id');
        });
    }
}
