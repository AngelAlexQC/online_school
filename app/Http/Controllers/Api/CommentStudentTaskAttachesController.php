<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentTaskAttachResource;
use App\Http\Resources\StudentTaskAttachCollection;

class CommentStudentTaskAttachesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Comment $comment)
    {
        $this->authorize('view', $comment);

        $search = $request->get('search', '');

        $studentTaskAttaches = $comment
            ->studentTaskAttaches()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentTaskAttachCollection($studentTaskAttaches);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        $this->authorize('create', StudentTaskAttach::class);

        $validated = $request->validate([]);

        $studentTaskAttach = $comment
            ->studentTaskAttaches()
            ->create($validated);

        return new StudentTaskAttachResource($studentTaskAttach);
    }
}
