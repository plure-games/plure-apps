<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveAppSettingToSeparateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('app_id')->references('id')->on('apps');

            $table->char('key', 255);
            $table->enum('value_type', [
                'array',
                'integer',
                'bool',
                'string'
            ]);
            $table->char('value', 255);
            $table->char('description', 255)->nullable();
            $table->enum('group', [
                'tutorial',
                'pwa_install'
            ])->nullable();

            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes();
        });

        Schema::table('apps', function(Blueprint $table) {
            $table->dropColumn('arbitrey_id');
            $table->dropColumn('currency_id');
            $table->dropColumn('currency_amount');
            $table->dropColumn('pwa_reward_currency_id');
            $table->dropColumn('pwa_reward_currency_amount');
            $table->dropColumn('level_lock');
            $table->dropColumn('show_pwa_after_game_x');
            $table->dropColumn('tutorial_enabled');
            $table->dropColumn('starting_score');
            $table->dropColumn('opponents');
            $table->dropColumn('moves_before_score_tutorial');
            $table->dropColumn('tutorial_currency_id');
            $table->dropColumn('tutorial_currency_amount');
            $table->dropColumn('registration_currency_id');
            $table->dropColumn('registration_currency_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
        Schema::table(
            'apps',
            function (Blueprint $table) {
                $table->unsignedBigInteger('currency_id')->default(
                    optional(\DB::table('currencies')->where('currency', 'diamonds')->first())->id ?? 1
                );
                $table->bigInteger('currency_amount')->default(200000000);
                $table->unsignedBigInteger('pwa_reward_currency_id')->nullable();
                $table->unsignedBigInteger('pwa_reward_currency_amount')->nullable();
                $table->boolean('level_lock')->default(false);
                $table->smallInteger('show_pwa_after_game_x')->default(1);
                $table->boolean('tutorial_enabled')->default(false);
                $table->integer('starting_score')->default(0);
                $table->text('opponents')->nullable();
                $table->text('arbitrey_id')->nullable();
                $table->integer('moves_before_score_tutorial')->default(0);
                $table->unsignedBigInteger('tutorial_currency_id')->nullable();
                $table->unsignedBigInteger('tutorial_currency_amount')->nullable();
                $table->text('opponents')->default('[]')->change();
                $table->unsignedBigInteger('registration_currency_id')->nullable();
                $table->unsignedBigInteger('registration_currency_amount')->nullable();
            }
        );
    }
}
