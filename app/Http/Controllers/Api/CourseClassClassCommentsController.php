<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassCommentResource;
use App\Http\Resources\ClassCommentCollection;

class CourseClassClassCommentsController extends Controller
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

        $classComments = $courseClass
            ->classComments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ClassCommentCollection($classComments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CourseClass $courseClass)
    {
        $this->authorize('create', ClassComment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'comment_id' => ['required', 'exists:comments,id'],
        ]);

        $classComment = $courseClass->classComments()->create($validated);

        return new ClassCommentResource($classComment);
    }
}
