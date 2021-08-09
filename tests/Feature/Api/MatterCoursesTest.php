<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Matter;
use App\Models\Course;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatterCoursesTest extends TestCase
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
    public function it_gets_matter_courses()
    {
        $matter = Matter::factory()->create();
        $courses = Course::factory()
            ->count(2)
            ->create([
                'matter_id' => $matter->id,
            ]);

        $response = $this->getJson(route('api.matters.courses.index', $matter));

        $response->assertOk()->assertSee($courses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_matter_courses()
    {
        $matter = Matter::factory()->create();
        $data = Course::factory()
            ->make([
                'matter_id' => $matter->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.matters.courses.store', $matter),
            $data
        );

        $this->assertDatabaseHas('courses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $course = Course::latest('id')->first();

        $this->assertEquals($matter->id, $course->matter_id);
    }
}
