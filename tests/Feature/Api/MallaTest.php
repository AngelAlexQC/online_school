<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Malla;

use App\Models\Career;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MallaTest extends TestCase
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
    public function it_gets_mallas_list()
    {
        $mallas = Malla::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.mallas.index'));

        $response->assertOk()->assertSee($mallas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_malla()
    {
        $data = Malla::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.mallas.store'), $data);

        $this->assertDatabaseHas('mallas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.mallas.update', $malla), $data);

        $data['id'] = $malla->id;

        $this->assertDatabaseHas('mallas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_malla()
    {
        $malla = Malla::factory()->create();

        $response = $this->deleteJson(route('api.mallas.destroy', $malla));

        $this->assertSoftDeleted($malla);

        $response->assertNoContent();
    }
}
