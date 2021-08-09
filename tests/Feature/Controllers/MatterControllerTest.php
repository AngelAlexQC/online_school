<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Matter;

use App\Models\Level;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatterControllerTest extends TestCase
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
    public function it_displays_index_view_with_matters()
    {
        $matters = Matter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('matters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.matters.index')
            ->assertViewHas('matters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_matter()
    {
        $response = $this->get(route('matters.create'));

        $response->assertOk()->assertViewIs('app.matters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_matter()
    {
        $data = Matter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('matters.store'), $data);

        $this->assertDatabaseHas('matters', $data);

        $matter = Matter::latest('id')->first();

        $response->assertRedirect(route('matters.edit', $matter));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_matter()
    {
        $matter = Matter::factory()->create();

        $response = $this->get(route('matters.show', $matter));

        $response
            ->assertOk()
            ->assertViewIs('app.matters.show')
            ->assertViewHas('matter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_matter()
    {
        $matter = Matter::factory()->create();

        $response = $this->get(route('matters.edit', $matter));

        $response
            ->assertOk()
            ->assertViewIs('app.matters.edit')
            ->assertViewHas('matter');
    }

    /**
     * @test
     */
    public function it_updates_the_matter()
    {
        $matter = Matter::factory()->create();

        $level = Level::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'credits' => $this->faker->randomNumber,
            'level_id' => $level->id,
        ];

        $response = $this->put(route('matters.update', $matter), $data);

        $data['id'] = $matter->id;

        $this->assertDatabaseHas('matters', $data);

        $response->assertRedirect(route('matters.edit', $matter));
    }

    /**
     * @test
     */
    public function it_deletes_the_matter()
    {
        $matter = Matter::factory()->create();

        $response = $this->delete(route('matters.destroy', $matter));

        $response->assertRedirect(route('matters.index'));

        $this->assertSoftDeleted($matter);
    }
}
