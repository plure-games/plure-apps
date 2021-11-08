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
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];
    }
}
