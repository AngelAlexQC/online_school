<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseClassResource;
use App\Http\Resources\CourseClassCollection;
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
            ->paginate();

        return new CourseClassCollection($courseClasses);
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

        return new CourseClassResource($courseClass);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CourseClass $courseClass)
    {
        $this->authorize('view', $courseClass);

        return new CourseClassResource($courseClass);
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

        return new CourseClassResource($courseClass);
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

        return response()->json($courseClass);
    }
}
