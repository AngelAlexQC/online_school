<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Level;
use App\Models\Malla;
use App\Models\Matter;
use App\Models\Period;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class CourseClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        for ($i = 0; $i < count($courses); $i++) {
            for ($j = 1; $j <= 5; $j++) {
                CourseClass::factory()
                    ->create([
                        'course_id' => $courses[$i]->id,
                        'number' => $j,
                        'name' => 'Clase #' . $j . ": Tema de clase " . $j
                    ]);
            }
        }
    }
}
