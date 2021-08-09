<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CourseClass;
use App\Models\Assistances;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseClassAllAssistancesTest extends TestCase
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
    public function it_gets_course_class_all_assistances()
    {
        $courseClass = CourseClass::factory()->create();
        $allAssistances = Assistances::factory()
            ->count(2)
            ->create([
                'course_class_id' => $courseClass->id,
            ]);

        $response = $this->getJson(
            route('api.course-classes.all-assistances.index', $courseClass)
        );

        $response->assertOk()->assertSee($allAssistances[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_class_all_assistances()
    {
        $courseClass = CourseClass::factory()->create();
        $data = Assistances::factory()
            ->make([
                'course_class_id' => $courseClass->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.course-classes.all-assistances.store', $courseClass),
            $data
        );

        unset($data['course_class_id']);
        unset($data['student_id']);

        $this->assertDatabaseHas('assistances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assistances = Assistances::latest('id')->first();

        $this->assertEquals($courseClass->id, $assistances->course_class_id);
    }
}
