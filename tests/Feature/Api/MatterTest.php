<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Matter;

use App\Models\Level;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'guirudj007@gmail.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_matters_list()
    {
        $matters = Matter::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.matters.index'));

        $response->assertOk()->assertSee($matters[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_matter()
    {
        $data = Matter::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.matters.store'), $data);

        $this->assertDatabaseHas('matters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.matters.update', $matter), $data);

        $data['id'] = $matter->id;

        $this->assertDatabaseHas('matters', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_matter()
    {
        $matter = Matter::factory()->create();

        $response = $this->deleteJson(route('api.matters.destroy', $matter));

        $this->assertSoftDeleted($matter);

        $response->assertNoContent();
    }
}
