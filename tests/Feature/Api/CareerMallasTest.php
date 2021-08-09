<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Malla;
use App\Models\Career;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CareerMallasTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
    public function it_gets_career_mallas()
    {
        $career = Career::factory()->create();
        $mallas = Malla::factory()
            ->count(2)
            ->create([
                'career_id' => $career->id,
            ]);

        $response = $this->getJson(route('api.careers.mallas.index', $career));

        $response->assertOk()->assertSee($mallas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_career_mallas()
    {
        $career = Career::factory()->create();
        $data = Malla::factory()
            ->make([
                'career_id' => $career->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.careers.mallas.store', $career),
            $data
        );

        $this->assertDatabaseHas('mallas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $malla = Malla::latest('id')->first();

        $this->assertEquals($career->id, $malla->career_id);
    }
}
