<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Comment;
use App\Models\StudentTaskAttach;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentStudentTaskAttachesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'guirudj007@gmail.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_comment_student_task_attaches()
    {
        $comment = Comment::factory()->create();
        $studentTaskAttaches = StudentTaskAttach::factory()
            ->count(2)
            ->create([
                'attach_id' => $comment->id,
            ]);

        $response = $this->getJson(
            route('api.comments.student-task-attaches.index', $comment)
        );

        $response->assertOk()->assertSee($studentTaskAttaches[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_comment_student_task_attaches()
    {
        $comment = Comment::factory()->create();
        $data = StudentTaskAttach::factory()
            ->make([
                'attach_id' => $comment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.comments.student-task-attaches.store', $comment),
            $data
        );

        unset($data['student_task_id']);

        $this->assertDatabaseHas('student_task_attaches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $studentTaskAttach = StudentTaskAttach::latest('id')->first();

        $this->assertEquals($comment->id, $studentTaskAttach->attach_id);
    }
}
