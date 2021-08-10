<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::firstOrCreate([
            'name' => 'Escuelita de Prueba',
            'address' => 'Calle de la Prueba',
            'phone' => '+593987654321',
            'slug' => 'escuelita-de-prueba',
            'url' => 'http://escuelita.com',
        ]);
    }
}
