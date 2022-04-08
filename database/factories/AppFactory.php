<?php

namespace PlureGames\PlureApps\Database\Factories;

use PlureGames\PlureApps\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AppFactory extends Factory
{
    protected $model = App::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'url' => $this->faker->url,
            'currency_id' => 2,
            'currency_amount' => 200000000,
            'show_pwa_after_game_x' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'registration_currency_id' => 2,
            'registration_currency_amount' => 200000000,
        ];
    }
}
