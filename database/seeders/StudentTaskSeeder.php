<?php

namespace Database\Seeders;

use App\Models\StudentTask;
use Illuminate\Database\Seeder;

class StudentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentTask::factory()
            ->count(5)
            ->create();
    }
}
