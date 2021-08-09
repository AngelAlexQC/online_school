<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'first_name' => 'Administrador',
                'last_name' => 'Del Sistema',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);



        $this->call(UserSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(MatterSeeder::class);
        $this->call(AdmissionSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(MallaSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(CourseClassTaskSeeder::class);
        $this->call(CourseClassSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(ClassCommentSeeder::class);
        $this->call(AssistancesSeeder::class);
        $this->call(AdmissionAtachSeeder::class);
        $this->call(StudentTaskSeeder::class);
        $this->call(StudentTaskAttachSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(EnrollmentSeeder::class);
    }
}
