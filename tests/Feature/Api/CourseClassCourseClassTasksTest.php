<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CourseClass;
use App\Models\CourseClassTask;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseClassCourseClassTasksTest extends TestCase
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
    public function it_gets_course_class_course_class_tasks()
    {
        $courseClass = CourseClass::factory()->create();
        $courseClassTasks = CourseClassTask::factory()
            ->count(2)
            ->create([
                'course_class_id' => $courseClass->id,
            ]);

        $response = $this->getJson(
            route('api.course-classes.course-class-tasks.index', $courseClass)
        );

        $response->assertOk()->assertSee($courseClassTasks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_class_course_class_tasks()
    {
        $courseClass = CourseClass::factory()->create();
        $data = CourseClassTask::factory()
            ->make([
                'course_class_id' => $courseClass->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.course-classes.course-class-tasks.store', $courseClass),
            $data
        );

        unset($data['course_class_id']);

        $this->assertDatabaseHas('course_class_tasks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $courseClassTask = CourseClassTask::latest('id')->first();

        $this->assertEquals(
            $courseClass->id,
            $courseClassTask->course_class_id
        );
    }
}
