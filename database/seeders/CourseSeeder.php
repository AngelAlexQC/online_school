<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Course;
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
        $courses = [
            [
                'name' => 'Matemática',
                'slug' => 'matematica',
                'description' => 'Las matemáticas son el área de las ciencias que estudia las propiedades de los números y las relaciones entre ellos.',
                'credits' => 10
            ],
            [
                'name' => 'Física',
                'slug' => 'fisica',
                'description' => 'Las físicas son el área de las ciencias que estudia los fenómenos que se pueden observar en la naturaleza.',
                'credits' => 10
            ], [
                'name' => 'Química',
                'slug' => 'quimica',
                'description' => 'Las químicas son el área de las ciencias que estudia las propiedades de los materiales y las reaciones entre ellos.',
                'credits' => 10
            ]
        ];
        foreach ($courses as $course) {
            Course::factory()
                ->create([
                    'matter_id' => Matter::firstOrCreate([
                        'name' => $course['name'],
                        'slug' => $course['slug'],
                        'description' => $course['description'],
                        'credits' => $course['credits'],
                        'level_id' => Level::firstOrCreate([
                            'name' => $level . 'º de Básica',
                            'number' => $level,
                            'malla_id' => Malla::firstOrCreate([
                                'name' => 'Primaria Básica',
                                'year' => Carbon::now()->year,
                                'career_id' => Career::firstOrCreate([
                                    'name' => 'Primaria Básica',
                                    'description' => 'La primaria básica es la primera etapa de la eduación donde se cursan las asignaturas básicas.',
                                    'school_id' => School::firstOrCreate([
                                        'name' => 'Escuelita de Prueba',
                                        'address' => 'Calle de la Prueba',
                                        'phone' => '+593987654321',
                                        'slug' => 'escuelita-de-prueba',
                                        'url' => 'http://escuelita.com',
                                    ])->id,
                                ])->id,
                            ])->id,
                        ])->id,
                    ]),
                    'period_id' => Period::firstOrCreate([
                        'school_id' =>  School::firstOrCreate([
                            'name' => 'Escuelita de Prueba',
                            'address' => 'Calle de la Prueba',
                            'phone' => '+593987654321',
                            'slug' => 'escuelita-de-prueba',
                            'url' => 'http://escuelita.com',
                        ])->id,
                        'name' => 'First Period',
                        'start_date' => '2021-01-01',
                        'end_date' => '2021-12-31',
                        'status' => true,
                    ])->id,
                    'teacher_id' => User::firstOrCreate([
                        'first_name' => 'Profesor',
                        'last_name' => 'de Prueba',
                        'email' => 'profesor@sistema.com',
                    ])->id,
                    'name' => Matter::firstOrCreate([
                        'name' => 'Matemática',
                        'slug' => $course['slug'],
                        'credits' => '10',
                        'description' => 'Las matemáticas son el área de las ciencias que estudia las propiedades de los números y las relaciones entre ellos.',
                        'level_id' => Level::firstOrCreate([
                            'name' => '1ero de Básica',
                            'number' => 1,
                            'malla_id' => Malla::firstOrCreate([
                                'name' => 'Primaria Básica',
                                'year' => Carbon::now()->year,
                                'career_id' => Career::firstOrCreate([
                                    'name' => 'Primaria Básica',
                                    'description' => 'La primaria básica es la primera etapa de la eduación donde se cursan las asignaturas básicas.',
                                    'school_id' => School::firstOrCreate([
                                        'name' => 'Escuelita de Prueba',
                                        'address' => 'Calle de la Prueba',
                                        'phone' => '+593987654321',
                                        'slug' => 'escuelita-de-prueba',
                                        'url' => 'http://escuelita.com',
                                    ])->id,
                                ])->id,
                            ])->id,
                        ])->id,
                    ])->name,
                    'slug' => $course['slug'],
                ]);
        }
    }
}
