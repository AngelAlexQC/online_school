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

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = 1;
        $matters = Matter::all();
        for ($i = 0; $i < count($matters); $i++) {
            Course::firstOrCreate([
                'matter_id' => $matters[$i]->id,
                'period_id' => 1,
                'teacher_id' => User::firstOrCreate([
                    'first_name' => 'Profesor',
                    'last_name' => 'de Prueba',
                    'email' => 'profesor@sistema.com',
                ])->id,
                'name' => $matters[$i]->name,
                'slug' => $matters[$i]->slug,
                'description' => $matters[$i]->description,
                'credits' => $matters[$i]->credits,
            ]);
        }
    }
}
