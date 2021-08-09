<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentTaskAttach;

class StudentTaskAttachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentTaskAttach::factory()
            ->count(5)
            ->create();
    }
}
