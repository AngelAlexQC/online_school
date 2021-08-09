<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Admission;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAdmissionsTest extends TestCase
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
    public function it_gets_user_admissions()
    {
        $user = User::factory()->create();
        $admissions = Admission::factory()
            ->count(2)
            ->create([
                'requester_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.admissions.index', $user));

        $response->assertOk()->assertSee($admissions[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_user_admissions()
    {
        $user = User::factory()->create();
        $data = Admission::factory()
            ->make([
                'requester_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.admissions.store', $user),
            $data
        );

        $this->assertDatabaseHas('admissions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $admission = Admission::latest('id')->first();

        $this->assertEquals($user->id, $admission->requester_id);
    }
}
