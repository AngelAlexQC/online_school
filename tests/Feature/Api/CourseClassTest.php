<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CourseClass;

use App\Models\Course;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseClassTest extends TestCase
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
    public function it_gets_course_classes_list()
    {
        $courseClasses = CourseClass::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.course-classes.index'));

        $response->assertOk()->assertSee($courseClasses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_class()
    {
        $data = CourseClass::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.course-classes.store'), $data);

        $this->assertDatabaseHas('course_classes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_course_class()
    {
        $courseClass = CourseClass::factory()->create();

        $course = Course::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'content' => $this->faker->text,
            'course_id' => $course->id,
        ];

        $response = $this->putJson(
            route('api.course-classes.update', $courseClass),
            $data
        );

        $data['id'] = $courseClass->id;

        $this->assertDatabaseHas('course_classes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_course_class()
    {
        $courseClass = CourseClass::factory()->create();

        $response = $this->deleteJson(
            route('api.course-classes.destroy', $courseClass)
        );

        $this->assertSoftDeleted($courseClass);

        $response->assertNoContent();
    }
}
