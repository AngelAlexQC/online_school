<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::firstOrCreate([
            'name' => 1 . 'º de Básica',
            'number' => 1,
            'malla_id' => 1,
        ]);
    }
}
