<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseEnrollmentsTest extends TestCase
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
    public function it_gets_course_enrollments()
    {
        $course = Course::factory()->create();
        $enrollments = Enrollment::factory()
            ->count(2)
            ->create([
                'course_id' => $course->id,
            ]);

        $response = $this->getJson(
            route('api.courses.enrollments.index', $course)
        );

        $response->assertOk()->assertSee($enrollments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_enrollments()
    {
        $course = Course::factory()->create();
        $data = Enrollment::factory()
            ->make([
                'course_id' => $course->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courses.enrollments.store', $course),
            $data
        );

        $this->assertDatabaseHas('enrollments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $enrollment = Enrollment::latest('id')->first();

        $this->assertEquals($course->id, $enrollment->course_id);
    }
}
