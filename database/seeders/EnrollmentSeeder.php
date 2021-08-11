<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            Enrollment::factory()
                ->count(5)
                ->create([
                    'course_id' => $course->id,
                ]);
        }
    }
}
