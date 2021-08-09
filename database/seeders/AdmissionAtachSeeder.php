<?php

namespace Database\Seeders;

use App\Models\AdmissionAtach;
use Illuminate\Database\Seeder;

class AdmissionAtachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdmissionAtach::factory()
            ->count(5)
            ->create();
    }
}
