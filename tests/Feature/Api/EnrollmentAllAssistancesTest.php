<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\Assistances;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentAllAssistancesTest extends TestCase
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
    public function it_gets_enrollment_all_assistances()
    {
        $enrollment = Enrollment::factory()->create();
        $allAssistances = Assistances::factory()
            ->count(2)
            ->create([
                'student_id' => $enrollment->id,
            ]);

        $response = $this->getJson(
            route('api.enrollments.all-assistances.index', $enrollment)
        );

        $response->assertOk()->assertSee($allAssistances[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_enrollment_all_assistances()
    {
        $enrollment = Enrollment::factory()->create();
        $data = Assistances::factory()
            ->make([
                'student_id' => $enrollment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.enrollments.all-assistances.store', $enrollment),
            $data
        );

        unset($data['course_class_id']);
        unset($data['student_id']);

        $this->assertDatabaseHas('assistances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assistances = Assistances::latest('id')->first();

        $this->assertEquals($enrollment->id, $assistances->student_id);
    }
}
