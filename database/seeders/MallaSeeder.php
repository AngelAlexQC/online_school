<?php

namespace Database\Seeders;

use App\Models\Malla;
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
        Malla::factory()
            ->count(5)
            ->create();
    }
}
