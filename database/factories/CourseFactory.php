<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

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
            'description' => $this->faker->paragraph,
            'credits' => $this->faker->randomDigit,
            'matter_id' => \App\Models\Matter::factory(),
            'period_id' => \App\Models\Period::factory(),
            'teacher_id' => \App\Models\User::factory(),
        ];
    }
}
