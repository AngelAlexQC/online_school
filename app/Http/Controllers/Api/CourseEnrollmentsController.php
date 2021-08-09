<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;
use App\Http\Resources\EnrollmentCollection;

class CourseEnrollmentsController extends Controller
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

        $enrollments = $course
            ->enrollments()
            ->search($search)
            ->latest()
            ->paginate();

        return new EnrollmentCollection($enrollments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $this->authorize('create', Enrollment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $enrollment = $course->enrollments()->create($validated);

        return new EnrollmentResource($enrollment);
    }
}
