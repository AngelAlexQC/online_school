<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseClass;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseCourseClassesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
    public function it_gets_course_course_classes()
    {
        $course = Course::factory()->create();
        $courseClasses = CourseClass::factory()
            ->count(2)
            ->create([
                'course_id' => $course->id,
            ]);

        $response = $this->getJson(
            route('api.courses.course-classes.index', $course)
        );

        $response->assertOk()->assertSee($courseClasses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_course_classes()
    {
        $course = Course::factory()->create();
        $data = CourseClass::factory()
            ->make([
                'course_id' => $course->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courses.course-classes.store', $course),
            $data
        );

        $this->assertDatabaseHas('course_classes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $courseClass = CourseClass::latest('id')->first();

        $this->assertEquals($course->id, $courseClass->course_id);
    }
}
