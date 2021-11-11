<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlToApps extends Migration
{
    public function up()
    {
        Schema::table(
            'apps',
            function (Blueprint $table) {
                $table->string('url')->after('name')->nullable();
            }
        );
    }

    public function down()
    {
        Schema::table(
            'apps',
            function (Blueprint $table) {
                $table->dropColumn('apps');
            }
        );
    }
}
