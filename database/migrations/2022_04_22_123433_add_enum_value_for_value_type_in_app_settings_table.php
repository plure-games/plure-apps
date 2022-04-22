<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumValueForValueTypeInAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `app_settings` CHANGE `value_type` `value_type` ENUM('array','integer','bool','string','currency') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE `app_settings` CHANGE `value_type` `value_type` ENUM('array','integer','bool','string') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    }
}
