<?php

namespace Database\Factories;

use App\Models\CourseClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseClass::class;

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
            'content' => $this->faker->text,
            'date_start' => $this->faker->date,
            'date_end' => $this->faker->date,
            'course_id' => \App\Models\Course::factory(),
        ];
    }
}
