<?php

namespace Database\Seeders;

use App\Models\CourseClass;
use Illuminate\Database\Seeder;
use App\Models\CourseClassTask;

class CourseClassTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseClasses = CourseClass::all();
        $courseClasses->each(function ($courseClass) {
            CourseClassTask::factory()->count(1)
                ->create([
                    'name' => 'Tarea de clase ' . $courseClass->number,
                    'description' => 'Descripción de la tarea de clase ' . $courseClass->number,
                    'course_class_id' => $courseClass->id,
                ]);
        });
    }
}
