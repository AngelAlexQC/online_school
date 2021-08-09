<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StudentTask;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStudentTasksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_student_tasks()
    {
        $user = User::factory()->create();
        $studentTasks = StudentTask::factory()
            ->count(2)
            ->create([
                'student_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.student-tasks.index', $user)
        );

        $response->assertOk()->assertSee($studentTasks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_student_tasks()
    {
        $user = User::factory()->create();
        $data = StudentTask::factory()
            ->make([
                'student_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.student-tasks.store', $user),
            $data
        );

        $this->assertDatabaseHas('student_tasks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $studentTask = StudentTask::latest('id')->first();

        $this->assertEquals($user->id, $studentTask->student_id);
    }
}
