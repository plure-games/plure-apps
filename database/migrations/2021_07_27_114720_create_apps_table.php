<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'apps',
            function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('name');

                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('created_at')->useCurrent();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
