<?php

namespace PlureGames\PlureApps\Database\Factories;

use App\Services\Micros;
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
            'currency_amount' => Micros::to($this->faker->randomDigit()),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];
    }
}
