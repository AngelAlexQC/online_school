<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassCommentResource;
use App\Http\Resources\ClassCommentCollection;

class CommentClassCommentsController extends Controller
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

        $classComments = $comment
            ->classComments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ClassCommentCollection($classComments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        $this->authorize('create', ClassComment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $classComment = $comment->classComments()->create($validated);

        return new ClassCommentResource($classComment);
    }
}
