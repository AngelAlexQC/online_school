<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Career;

use App\Models\School;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CareerTest extends TestCase
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
    public function it_gets_careers_list()
    {
        $careers = Career::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.careers.index'));

        $response->assertOk()->assertSee($careers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_career()
    {
        $data = Career::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.careers.store'), $data);

        $this->assertDatabaseHas('careers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.careers.update', $career), $data);

        $data['id'] = $career->id;

        $this->assertDatabaseHas('careers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_career()
    {
        $career = Career::factory()->create();

        $response = $this->deleteJson(route('api.careers.destroy', $career));

        $this->assertSoftDeleted($career);

        $response->assertNoContent();
    }
}
