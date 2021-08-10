<?php

namespace Database\Factories;

use App\Models\Matter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Matter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'credits' => $this->faker->randomNumber,
            'description' => $this->faker->sentence(15),
            'level_id' => \App\Models\Level::factory(),
        ];
    }
}
