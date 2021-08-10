<?php

namespace Database\Seeders;

use App\Models\Matter;
use Illuminate\Database\Seeder;

class MatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            ],
            [
                'name' => 'Química',
                'slug' => 'quimica',
                'description' => 'Las químicas son el área de las ciencias que estudia las propiedades de los materiales y las reaciones entre ellos.',
                'credits' => 10
            ]
        ];
        foreach ($courses as $course) {
            Matter::firstOrCreate([
                'name' => $course['name'],
                'slug' => $course['slug'],
                'description' => $course['description'],
                'credits' => $course['credits'],
                'level_id' => 1,
            ]);
        }
    }
}
