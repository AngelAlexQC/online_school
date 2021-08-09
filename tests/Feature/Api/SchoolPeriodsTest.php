<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\School;
use App\Models\Period;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolPeriodsTest extends TestCase
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
    public function it_gets_school_periods()
    {
        $school = School::factory()->create();
        $periods = Period::factory()
            ->count(2)
            ->create([
                'school_id' => $school->id,
            ]);

        $response = $this->getJson(route('api.schools.periods.index', $school));

        $response->assertOk()->assertSee($periods[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_school_periods()
    {
        $school = School::factory()->create();
        $data = Period::factory()
            ->make([
                'school_id' => $school->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.schools.periods.store', $school),
            $data
        );

        unset($data['school_id']);

        $this->assertDatabaseHas('periods', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $period = Period::latest('id')->first();

        $this->assertEquals($school->id, $period->school_id);
    }
}
