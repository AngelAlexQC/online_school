<?php

namespace Database\Seeders;

use App\Models\Assistances;
use Illuminate\Database\Seeder;

class AssistancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistances::factory()
            ->count(5)
            ->create();
    }
}
