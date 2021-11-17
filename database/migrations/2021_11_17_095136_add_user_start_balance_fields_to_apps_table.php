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
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table(
            'apps',
            function (Blueprint $table) {
                $table->unsignedBigInteger('currency_id')->default(
                    optional(\DB::table('currencies')->where('currency', 'diamonds')->first())->id ?? 1
                );
                $table->bigInteger('currency_amount')->default(200000000);
            }
        );
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table(
            'apps',
            function (Blueprint $table) {
                $table->dropColumn('currency_id');
                $table->dropColumn('currency_amount');
            }
        );
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
