<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber,
            'name' => $this->faker->name,
            'malla_id' => \App\Models\Malla::factory(),
        ];
    }
}
