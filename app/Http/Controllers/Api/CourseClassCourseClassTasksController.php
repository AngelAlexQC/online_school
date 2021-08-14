<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseClassTaskResource;
use App\Http\Resources\CourseClassTaskCollection;

class CourseClassCourseClassTasksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CourseClass $courseClass)
    {
        $this->authorize('view', $courseClass);

        $search = $request->get('search', '');

        $courseClassTasks = $courseClass
            ->courseClassTasks()
            ->search($search)
            ->latest()
            ->paginate();

        return new CourseClassTaskCollection($courseClassTasks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CourseClass $courseClass)
    {
        $this->authorize('create', CourseClassTask::class);

        $validated = $request->validate([
            'name' => ['nullable', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'description' => ['required'],
            'file' => ['nullable', 'file'],
            'score' => ['required', 'numeric'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $courseClassTask = $courseClass->courseClassTasks()->create($validated);

        return new CourseClassTaskResource($courseClassTask);
    }
}
