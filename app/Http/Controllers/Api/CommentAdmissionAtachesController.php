<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionAtachResource;
use App\Http\Resources\AdmissionAtachCollection;

class CommentAdmissionAtachesController extends Controller
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

        $admissionAtaches = $comment
            ->admissionAtaches()
            ->search($search)
            ->latest()
            ->paginate();

        return new AdmissionAtachCollection($admissionAtaches);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        $this->authorize('create', AdmissionAtach::class);

        $validated = $request->validate([]);

        $admissionAtach = $comment->admissionAtaches()->create($validated);

        return new AdmissionAtachResource($admissionAtach);
    }
}
