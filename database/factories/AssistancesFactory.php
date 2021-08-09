<?php

namespace Database\Factories;

use App\Models\Assistances;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssistancesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assistances::class;

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
            'course_class_id' => \App\Models\CourseClass::factory(),
        ];
    }
}
