<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AdmissionAtach;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdmissionAtachFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdmissionAtach::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'admission_id' => \App\Models\Admission::factory(),
        ];
    }
}
