<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'student_id' => \App\Models\User::factory(),
            'course_id' => \App\Models\Course::factory(),
        ];
    }
}
