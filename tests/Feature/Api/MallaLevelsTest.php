<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Malla;
use App\Models\Level;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MallaLevelsTest extends TestCase
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
    public function it_gets_malla_levels()
    {
        $malla = Malla::factory()->create();
        $levels = Level::factory()
            ->count(2)
            ->create([
                'malla_id' => $malla->id,
            ]);

        $response = $this->getJson(route('api.mallas.levels.index', $malla));

        $response->assertOk()->assertSee($levels[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_malla_levels()
    {
        $malla = Malla::factory()->create();
        $data = Level::factory()
            ->make([
                'malla_id' => $malla->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mallas.levels.store', $malla),
            $data
        );

        unset($data['malla_id']);

        $this->assertDatabaseHas('levels', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $level = Level::latest('id')->first();

        $this->assertEquals($malla->id, $level->malla_id);
    }
}
