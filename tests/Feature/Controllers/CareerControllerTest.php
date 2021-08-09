<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Career;

use App\Models\School;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CareerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_careers()
    {
        $careers = Career::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('careers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.careers.index')
            ->assertViewHas('careers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_career()
    {
        $response = $this->get(route('careers.create'));

        $response->assertOk()->assertViewIs('app.careers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_career()
    {
        $data = Career::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('careers.store'), $data);

        $this->assertDatabaseHas('careers', $data);

        $career = Career::latest('id')->first();

        $response->assertRedirect(route('careers.edit', $career));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_career()
    {
        $career = Career::factory()->create();

        $response = $this->get(route('careers.show', $career));

        $response
            ->assertOk()
            ->assertViewIs('app.careers.show')
            ->assertViewHas('career');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_career()
    {
        $career = Career::factory()->create();

        $response = $this->get(route('careers.edit', $career));

        $response
            ->assertOk()
            ->assertViewIs('app.careers.edit')
            ->assertViewHas('career');
    }

    /**
     * @test
     */
    public function it_updates_the_career()
    {
        $career = Career::factory()->create();

        $school = School::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'school_id' => $school->id,
        ];

        $response = $this->put(route('careers.update', $career), $data);

        $data['id'] = $career->id;

        $this->assertDatabaseHas('careers', $data);

        $response->assertRedirect(route('careers.edit', $career));
    }

    /**
     * @test
     */
    public function it_deletes_the_career()
    {
        $career = Career::factory()->create();

        $response = $this->delete(route('careers.destroy', $career));

        $response->assertRedirect(route('careers.index'));

        $this->assertSoftDeleted($career);
    }
}
