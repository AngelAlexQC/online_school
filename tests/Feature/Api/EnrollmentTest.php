<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Enrollment;

use App\Models\Course;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
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
    public function it_gets_enrollments_list()
    {
        $enrollments = Enrollment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.enrollments.index'));

        $response->assertOk()->assertSee($enrollments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_enrollment()
    {
        $data = Enrollment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.enrollments.store'), $data);

        $this->assertDatabaseHas('enrollments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $user = User::factory()->create();
        $course = Course::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'student_id' => $user->id,
            'course_id' => $course->id,
        ];

        $response = $this->putJson(
            route('api.enrollments.update', $enrollment),
            $data
        );

        $data['id'] = $enrollment->id;

        $this->assertDatabaseHas('enrollments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->deleteJson(
            route('api.enrollments.destroy', $enrollment)
        );

        $this->assertDeleted($enrollment);

        $response->assertNoContent();
    }
}
