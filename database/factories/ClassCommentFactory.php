<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClassComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'comment_id' => \App\Models\Comment::factory(),
            'course_class_id' => \App\Models\CourseClass::factory(),
        ];
    }
}
