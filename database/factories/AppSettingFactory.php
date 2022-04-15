<?php

namespace PlureGames\PlureApps\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PlureGames\PlureApps\Models\AppSetting;

class AppSettingFactory extends Factory
{
    protected $model = AppSetting::class;

    public function definition(): array
    {
        return [
            'app_id' => 1,
            'key' => $this->faker->word(),
            'value_type' => 'string',
            'value' => $this->faker->word(),
            'description' => '',
        ];
    }
}
