<?php

namespace Database\Factories;

use App\Models\Malla;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MallaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Malla::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'year' => $this->faker->year,
            'career_id' => \App\Models\Career::factory(),
        ];
    }
}
