<?php

namespace Database\Seeders;

use App\Models\CourseClass;
use Illuminate\Database\Seeder;

class CourseClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseClass::factory()
            ->count(5)
            ->create();
    }
}
