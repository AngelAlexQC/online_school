<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Comment;
use App\Models\ClassComment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentClassCommentsTest extends TestCase
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
    public function it_gets_comment_class_comments()
    {
        $comment = Comment::factory()->create();
        $classComments = ClassComment::factory()
            ->count(2)
            ->create([
                'comment_id' => $comment->id,
            ]);

        $response = $this->getJson(
            route('api.comments.class-comments.index', $comment)
        );

        $response->assertOk()->assertSee($classComments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_comment_class_comments()
    {
        $comment = Comment::factory()->create();
        $data = ClassComment::factory()
            ->make([
                'comment_id' => $comment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.comments.class-comments.store', $comment),
            $data
        );

        unset($data['course_class_id']);

        $this->assertDatabaseHas('class_comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $classComment = ClassComment::latest('id')->first();

        $this->assertEquals($comment->id, $classComment->comment_id);
    }
}
