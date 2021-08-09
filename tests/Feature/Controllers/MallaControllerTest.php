<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Malla;

use App\Models\Career;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MallaControllerTest extends TestCase
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
    public function it_displays_index_view_with_mallas()
    {
        $mallas = Malla::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('mallas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.mallas.index')
            ->assertViewHas('mallas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_malla()
    {
        $response = $this->get(route('mallas.create'));

        $response->assertOk()->assertViewIs('app.mallas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_malla()
    {
        $data = Malla::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('mallas.store'), $data);

        $this->assertDatabaseHas('mallas', $data);

        $malla = Malla::latest('id')->first();

        $response->assertRedirect(route('mallas.edit', $malla));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_malla()
    {
        $malla = Malla::factory()->create();

        $response = $this->get(route('mallas.show', $malla));

        $response
            ->assertOk()
            ->assertViewIs('app.mallas.show')
            ->assertViewHas('malla');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_malla()
    {
        $malla = Malla::factory()->create();

        $response = $this->get(route('mallas.edit', $malla));

        $response
            ->assertOk()
            ->assertViewIs('app.mallas.edit')
            ->assertViewHas('malla');
    }

    /**
     * @test
     */
    public function it_updates_the_malla()
    {
        $malla = Malla::factory()->create();

        $career = Career::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'year' => $this->faker->year,
            'career_id' => $career->id,
        ];

        $response = $this->put(route('mallas.update', $malla), $data);

        $data['id'] = $malla->id;

        $this->assertDatabaseHas('mallas', $data);

        $response->assertRedirect(route('mallas.edit', $malla));
    }

    /**
     * @test
     */
    public function it_deletes_the_malla()
    {
        $malla = Malla::factory()->create();

        $response = $this->delete(route('mallas.destroy', $malla));

        $response->assertRedirect(route('mallas.index'));

        $this->assertSoftDeleted($malla);
    }
}
