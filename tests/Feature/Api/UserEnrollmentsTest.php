<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Enrollment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEnrollmentsTest extends TestCase
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
    public function it_gets_user_enrollments()
    {
        $user = User::factory()->create();
        $enrollments = Enrollment::factory()
            ->count(2)
            ->create([
                'student_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.enrollments.index', $user));

        $response->assertOk()->assertSee($enrollments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_enrollments()
    {
        $user = User::factory()->create();
        $data = Enrollment::factory()
            ->make([
                'student_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.enrollments.store', $user),
            $data
        );

        $this->assertDatabaseHas('enrollments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $enrollment = Enrollment::latest('id')->first();

        $this->assertEquals($user->id, $enrollment->student_id);
    }
}
