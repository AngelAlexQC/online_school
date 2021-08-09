<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Comment;
use App\Models\AdmissionAtach;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentAdmissionAtachesTest extends TestCase
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
    public function it_gets_comment_admission_ataches()
    {
        $comment = Comment::factory()->create();
        $admissionAtaches = AdmissionAtach::factory()
            ->count(2)
            ->create([
                'attach_id' => $comment->id,
            ]);

        $response = $this->getJson(
            route('api.comments.admission-ataches.index', $comment)
        );

        $response->assertOk()->assertSee($admissionAtaches[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_comment_admission_ataches()
    {
        $comment = Comment::factory()->create();
        $data = AdmissionAtach::factory()
            ->make([
                'attach_id' => $comment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.comments.admission-ataches.store', $comment),
            $data
        );

        unset($data['admission_id']);

        $this->assertDatabaseHas('admission_ataches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $admissionAtach = AdmissionAtach::latest('id')->first();

        $this->assertEquals($comment->id, $admissionAtach->attach_id);
    }
}
