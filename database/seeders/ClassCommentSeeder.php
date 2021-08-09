<?php

namespace Database\Seeders;

use App\Models\ClassComment;
use Illuminate\Database\Seeder;

class ClassCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassComment::factory()
            ->count(5)
            ->create();
    }
}
