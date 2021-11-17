<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserStartBalanceFieldsToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->bigInteger('currency_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn('currency_id');
            $table->dropColumn('currency_amount');
        });
    }
}
