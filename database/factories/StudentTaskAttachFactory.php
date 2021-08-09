<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StudentTaskAttach;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentTaskAttachFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentTaskAttach::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_task_id' => \App\Models\StudentTask::factory(),
            'attach_id' => \App\Models\Comment::factory(),
        ];
    }
}
