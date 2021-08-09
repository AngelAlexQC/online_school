<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CourseClass;

use App\Models\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseClassControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'guirudj007@gmail.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_course_classes()
    {
        $courseClasses = CourseClass::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('course-classes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.course_classes.index')
            ->assertViewHas('courseClasses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_course_class()
    {
        $response = $this->get(route('course-classes.create'));

        $response->assertOk()->assertViewIs('app.course_classes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_course_class()
    {
        $data = CourseClass::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('course-classes.store'), $data);

        $this->assertDatabaseHas('course_classes', $data);

        $courseClass = CourseClass::latest('id')->first();

        $response->assertRedirect(route('course-classes.edit', $courseClass));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_course_class()
    {
        $courseClass = CourseClass::factory()->create();

        $response = $this->get(route('course-classes.show', $courseClass));

        $response
            ->assertOk()
            ->assertViewIs('app.course_classes.show')
            ->assertViewHas('courseClass');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_course_class()
    {
        $courseClass = CourseClass::factory()->create();

        $response = $this->get(route('course-classes.edit', $courseClass));

        $response
            ->assertOk()
            ->assertViewIs('app.course_classes.edit')
            ->assertViewHas('courseClass');
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

        $response = $this->put(
            route('course-classes.update', $courseClass),
            $data
        );

        $data['id'] = $courseClass->id;

        $this->assertDatabaseHas('course_classes', $data);

        $response->assertRedirect(route('course-classes.edit', $courseClass));
    }

    /**
     * @test
     */
    public function it_deletes_the_course_class()
    {
        $courseClass = CourseClass::factory()->create();

        $response = $this->delete(
            route('course-classes.destroy', $courseClass)
        );

        $response->assertRedirect(route('course-classes.index'));

        $this->assertSoftDeleted($courseClass);
    }
}
