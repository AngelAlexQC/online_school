<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Admission;

use App\Models\Malla;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmissionTest extends TestCase
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
    public function it_gets_admissions_list()
    {
        $admissions = Admission::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.admissions.index'));

        $response->assertOk()->assertSee($admissions[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_admission()
    {
        $data = Admission::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.admissions.store'), $data);

        $this->assertDatabaseHas('admissions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.admissions.update', $admission),
            $data
        );

        $data['id'] = $admission->id;

        $this->assertDatabaseHas('admissions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_admission()
    {
        $admission = Admission::factory()->create();

        $response = $this->deleteJson(
            route('api.admissions.destroy', $admission)
        );

        $this->assertSoftDeleted($admission);

        $response->assertNoContent();
    }
}
