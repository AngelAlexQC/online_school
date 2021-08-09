<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseClassResource;
use App\Http\Resources\CourseClassCollection;

class CourseCourseClassesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Course $course)
    {
        $this->authorize('view', $course);

        $search = $request->get('search', '');

        $courseClasses = $course
            ->courseClasses()
            ->search($search)
            ->latest()
            ->paginate();

        return new CourseClassCollection($courseClasses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $this->authorize('create', CourseClass::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
        ]);

        $courseClass = $course->courseClasses()->create($validated);

        return new CourseClassResource($courseClass);
    }
}
