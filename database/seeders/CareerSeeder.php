<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Career::firstOrCreate([
            'name' => 'Primaria Básica',
            'description' => 'La primaria básica es la primera etapa de la eduación donde se cursan las asignaturas básicas.',
            'school_id' => 1
        ]);
    }
}
