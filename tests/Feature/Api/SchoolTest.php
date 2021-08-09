<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\School;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolTest extends TestCase
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
    public function it_gets_schools_list()
    {
        $schools = School::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.schools.index'));

        $response->assertOk()->assertSee($schools[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_school()
    {
        $data = School::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.schools.store'), $data);

        $this->assertDatabaseHas('schools', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_school()
    {
        $school = School::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'url' => $this->faker->url,
        ];

        $response = $this->putJson(route('api.schools.update', $school), $data);

        $data['id'] = $school->id;

        $this->assertDatabaseHas('schools', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_school()
    {
        $school = School::factory()->create();

        $response = $this->deleteJson(route('api.schools.destroy', $school));

        $this->assertSoftDeleted($school);

        $response->assertNoContent();
    }
}
