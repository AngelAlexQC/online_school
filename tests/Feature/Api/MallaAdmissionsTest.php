<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Malla;
use App\Models\Admission;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MallaAdmissionsTest extends TestCase
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
    public function it_gets_malla_admissions()
    {
        $malla = Malla::factory()->create();
        $admissions = Admission::factory()
            ->count(2)
            ->create([
                'malla_id' => $malla->id,
            ]);

        $response = $this->getJson(
            route('api.mallas.admissions.index', $malla)
        );

        $response->assertOk()->assertSee($admissions[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_malla_admissions()
    {
        $malla = Malla::factory()->create();
        $data = Admission::factory()
            ->make([
                'malla_id' => $malla->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mallas.admissions.store', $malla),
            $data
        );

        $this->assertDatabaseHas('admissions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $admission = Admission::latest('id')->first();

        $this->assertEquals($malla->id, $admission->malla_id);
    }
}
