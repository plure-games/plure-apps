<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTutorialSettingsFieldsToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->boolean('tutorial_enabled')->default(false);
            $table->integer('starting_score')->default(0);
            $table->text('opponents')->nullable();
            $table->integer('moves_before_score_tutorial')->default(0);
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
            $table->dropColumn('tutorial_enabled');
            $table->dropColumn('starting_score');
            $table->dropColumn('opponents');
            $table->dropColumn('moves_before_score_tutorial');
        });
    }
}
