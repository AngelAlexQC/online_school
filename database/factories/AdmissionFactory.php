<?php

namespace Database\Factories;

use App\Models\Admission;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->word,
            'malla_id' => \App\Models\Malla::factory(),
            'requester_id' => \App\Models\User::factory(),
        ];
    }
}
