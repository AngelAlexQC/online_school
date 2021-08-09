<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

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
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'url' => $this->faker->url,
        ];
    }
}
