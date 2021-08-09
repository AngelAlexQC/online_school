<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Requests\CourseClassStoreRequest;
use App\Http\Requests\CourseClassUpdateRequest;

class CourseClassController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CourseClass::class);

        $search = $request->get('search', '');

        $courseClasses = CourseClass::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.course_classes.index',
            compact('courseClasses', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CourseClass::class);

        $courses = Course::pluck('name', 'id');

        return view('app.course_classes.create', compact('courses'));
    }

    /**
     * @param \App\Http\Requests\CourseClassStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseClassStoreRequest $request)
    {
        $this->authorize('create', CourseClass::class);

        $validated = $request->validated();

        $courseClass = CourseClass::create($validated);

        return redirect()
            ->route('course-classes.edit', $courseClass)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CourseClass $courseClass)
    {
        $this->authorize('view', $courseClass);

        return view('app.course_classes.show', compact('courseClass'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CourseClass $courseClass)
    {
        $this->authorize('update', $courseClass);

        $courses = Course::pluck('name', 'id');

        return view(
            'app.course_classes.edit',
            compact('courseClass', 'courses')
        );
    }

    /**
     * @param \App\Http\Requests\CourseClassUpdateRequest $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function update(
        CourseClassUpdateRequest $request,
        CourseClass $courseClass
    ) {
        $this->authorize('update', $courseClass);

        $validated = $request->validated();

        $courseClass->update($validated);

        return redirect()
            ->route('course-classes.edit', $courseClass)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CourseClass $courseClass)
    {
        $this->authorize('delete', $courseClass);

        $courseClass->delete();

        return redirect()
            ->route('course-classes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
