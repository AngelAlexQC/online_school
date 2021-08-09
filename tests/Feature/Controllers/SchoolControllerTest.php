<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\School;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolControllerTest extends TestCase
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
    public function it_displays_index_view_with_schools()
    {
        $schools = School::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('schools.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.schools.index')
            ->assertViewHas('schools');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_school()
    {
        $response = $this->get(route('schools.create'));

        $response->assertOk()->assertViewIs('app.schools.create');
    }

    /**
     * @test
     */
    public function it_stores_the_school()
    {
        $data = School::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('schools.store'), $data);

        $this->assertDatabaseHas('schools', $data);

        $school = School::latest('id')->first();

        $response->assertRedirect(route('schools.edit', $school));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_school()
    {
        $school = School::factory()->create();

        $response = $this->get(route('schools.show', $school));

        $response
            ->assertOk()
            ->assertViewIs('app.schools.show')
            ->assertViewHas('school');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_school()
    {
        $school = School::factory()->create();

        $response = $this->get(route('schools.edit', $school));

        $response
            ->assertOk()
            ->assertViewIs('app.schools.edit')
            ->assertViewHas('school');
    }

    /**
     * @test
     */
    public function it_updates_the_school()
    {
        $school = School::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'url' => $this->faker->url,
        ];

        $response = $this->put(route('schools.update', $school), $data);

        $data['id'] = $school->id;

        $this->assertDatabaseHas('schools', $data);

        $response->assertRedirect(route('schools.edit', $school));
    }

    /**
     * @test
     */
    public function it_deletes_the_school()
    {
        $school = School::factory()->create();

        $response = $this->delete(route('schools.destroy', $school));

        $response->assertRedirect(route('schools.index'));

        $this->assertSoftDeleted($school);
    }
}
