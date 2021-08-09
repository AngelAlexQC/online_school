<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseClassTask;

class CourseClassTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseClassTask::factory()
            ->count(5)
            ->create();
    }
}
