<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Admission;

use App\Models\Malla;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmissionControllerTest extends TestCase
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
    public function it_displays_index_view_with_admissions()
    {
        $admissions = Admission::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('admissions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.admissions.index')
            ->assertViewHas('admissions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_admission()
    {
        $response = $this->get(route('admissions.create'));

        $response->assertOk()->assertViewIs('app.admissions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_admission()
    {
        $data = Admission::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('admissions.store'), $data);

        $this->assertDatabaseHas('admissions', $data);

        $admission = Admission::latest('id')->first();

        $response->assertRedirect(route('admissions.edit', $admission));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_admission()
    {
        $admission = Admission::factory()->create();

        $response = $this->get(route('admissions.show', $admission));

        $response
            ->assertOk()
            ->assertViewIs('app.admissions.show')
            ->assertViewHas('admission');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_admission()
    {
        $admission = Admission::factory()->create();

        $response = $this->get(route('admissions.edit', $admission));

        $response
            ->assertOk()
            ->assertViewIs('app.admissions.edit')
            ->assertViewHas('admission');
    }

    /**
     * @test
     */
    public function it_updates_the_admission()
    {
        $admission = Admission::factory()->create();

        $malla = Malla::factory()->create();
        $user = User::factory()->create();

        $data = [
            'status' => $this->faker->word,
            'malla_id' => $malla->id,
            'requester_id' => $user->id,
        ];

        $response = $this->put(route('admissions.update', $admission), $data);

        $data['id'] = $admission->id;

        $this->assertDatabaseHas('admissions', $data);

        $response->assertRedirect(route('admissions.edit', $admission));
    }

    /**
     * @test
     */
    public function it_deletes_the_admission()
    {
        $admission = Admission::factory()->create();

        $response = $this->delete(route('admissions.destroy', $admission));

        $response->assertRedirect(route('admissions.index'));

        $this->assertSoftDeleted($admission);
    }
}
