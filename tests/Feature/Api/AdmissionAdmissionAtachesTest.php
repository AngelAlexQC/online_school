<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Admission;
use App\Models\AdmissionAtach;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmissionAdmissionAtachesTest extends TestCase
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
    public function it_gets_admission_admission_ataches()
    {
        $admission = Admission::factory()->create();
        $admissionAtaches = AdmissionAtach::factory()
            ->count(2)
            ->create([
                'admission_id' => $admission->id,
            ]);

        $response = $this->getJson(
            route('api.admissions.admission-ataches.index', $admission)
        );

        $response->assertOk()->assertSee($admissionAtaches[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_admission_admission_ataches()
    {
        $admission = Admission::factory()->create();
        $data = AdmissionAtach::factory()
            ->make([
                'admission_id' => $admission->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.admissions.admission-ataches.store', $admission),
            $data
        );

        unset($data['admission_id']);

        $this->assertDatabaseHas('admission_ataches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $admissionAtach = AdmissionAtach::latest('id')->first();

        $this->assertEquals($admission->id, $admissionAtach->admission_id);
    }
}
