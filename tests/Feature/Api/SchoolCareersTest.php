<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\School;
use App\Models\Career;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolCareersTest extends TestCase
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
    public function it_gets_school_careers()
    {
        $school = School::factory()->create();
        $careers = Career::factory()
            ->count(2)
            ->create([
                'school_id' => $school->id,
            ]);

        $response = $this->getJson(route('api.schools.careers.index', $school));

        $response->assertOk()->assertSee($careers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_school_careers()
    {
        $school = School::factory()->create();
        $data = Career::factory()
            ->make([
                'school_id' => $school->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.schools.careers.store', $school),
            $data
        );

        $this->assertDatabaseHas('careers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $career = Career::latest('id')->first();

        $this->assertEquals($school->id, $career->school_id);
    }
}
