<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use PlureGames\PlureApps\Models\AppEnvironments;

class AppEnvironmentsFactory extends Factory
{
    protected $model = AppEnvironments::class;

    public function definition(): array
    {
        return [
            'app_id' => $this->faker->randomNumber(),
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
