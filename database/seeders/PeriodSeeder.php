<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\School;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::firstOrCreate([
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
        ]);
    }
}
