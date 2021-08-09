<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CourseClass;
use App\Models\ClassComment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseClassClassCommentsTest extends TestCase
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
    public function it_gets_course_class_class_comments()
    {
        $courseClass = CourseClass::factory()->create();
        $classComments = ClassComment::factory()
            ->count(2)
            ->create([
                'course_class_id' => $courseClass->id,
            ]);

        $response = $this->getJson(
            route('api.course-classes.class-comments.index', $courseClass)
        );

        $response->assertOk()->assertSee($classComments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course_class_class_comments()
    {
        $courseClass = CourseClass::factory()->create();
        $data = ClassComment::factory()
            ->make([
                'course_class_id' => $courseClass->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.course-classes.class-comments.store', $courseClass),
            $data
        );

        unset($data['course_class_id']);

        $this->assertDatabaseHas('class_comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $classComment = ClassComment::latest('id')->first();

        $this->assertEquals($courseClass->id, $classComment->course_class_id);
    }
}
