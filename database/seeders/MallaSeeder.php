<?php

namespace Database\Seeders;

use App\Models\Malla;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Malla::firstOrCreate([
            'name' => 'Primaria Básica',
            'year' => Carbon::now()->year,
            'career_id' => 1,
        ]);
    }
}
