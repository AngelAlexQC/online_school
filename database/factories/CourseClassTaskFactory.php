<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CourseClassTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseClassTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseClassTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'content' => $this->faker->text,
            'score' => $this->faker->randomNumber,
            'course_class_id' => \App\Models\CourseClass::factory(),
        ];
    }
}
