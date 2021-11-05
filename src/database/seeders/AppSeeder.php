<?php

namespace PlureGames\PlureApps\Database\Seeders;

use PlureGames\PlureApps\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        App::create(
            [
                'name' => 'Solitaire',
            ]
        );
    }
}
