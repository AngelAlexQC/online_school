<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Enrollment;

use App\Models\Course;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentControllerTest extends TestCase
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
    public function it_displays_index_view_with_enrollments()
    {
        $enrollments = Enrollment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('enrollments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.enrollments.index')
            ->assertViewHas('enrollments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_enrollment()
    {
        $response = $this->get(route('enrollments.create'));

        $response->assertOk()->assertViewIs('app.enrollments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_enrollment()
    {
        $data = Enrollment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('enrollments.store'), $data);

        $this->assertDatabaseHas('enrollments', $data);

        $enrollment = Enrollment::latest('id')->first();

        $response->assertRedirect(route('enrollments.edit', $enrollment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->get(route('enrollments.show', $enrollment));

        $response
            ->assertOk()
            ->assertViewIs('app.enrollments.show')
            ->assertViewHas('enrollment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->get(route('enrollments.edit', $enrollment));

        $response
            ->assertOk()
            ->assertViewIs('app.enrollments.edit')
            ->assertViewHas('enrollment');
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

        $response = $this->put(route('enrollments.update', $enrollment), $data);

        $data['id'] = $enrollment->id;

        $this->assertDatabaseHas('enrollments', $data);

        $response->assertRedirect(route('enrollments.edit', $enrollment));
    }

    /**
     * @test
     */
    public function it_deletes_the_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->delete(route('enrollments.destroy', $enrollment));

        $response->assertRedirect(route('enrollments.index'));

        $this->assertDeleted($enrollment);
    }
}
