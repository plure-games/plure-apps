<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPwaBonusToApps extends Migration
{
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->unsignedBigInteger('pwa_reward_currency_id')->nullable();
            $table->unsignedBigInteger('pwa_reward_currency_amount')->nullable();
        });
    }

    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn('pwa_reward_currency_id');
            $table->dropColumn('pwa_reward_currency_amount');
        });
    }
}
