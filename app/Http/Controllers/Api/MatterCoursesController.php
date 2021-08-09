<?php

namespace App\Http\Controllers\Api;

use App\Models\Matter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;

class MatterCoursesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Matter $matter)
    {
        $this->authorize('view', $matter);

        $search = $request->get('search', '');

        $courses = $matter
            ->courses()
            ->search($search)
            ->latest()
            ->paginate();

        return new CourseCollection($courses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Matter $matter)
    {
        $this->authorize('create', Course::class);

        $validated = $request->validate([
            'period_id' => ['required', 'exists:periods,id'],
            'name' => ['required', 'max:255', 'string'],
        ]);

        $course = $matter->courses()->create($validated);

        return new CourseResource($course);
    }
}
