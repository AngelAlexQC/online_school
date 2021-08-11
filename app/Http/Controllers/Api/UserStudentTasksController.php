<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentTaskResource;
use App\Http\Resources\StudentTaskCollection;
use App\Models\StudentTask;

class UserStudentTasksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $studentTasks = $user
            ->studentTasks()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentTaskCollection($studentTasks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', StudentTask::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $studentTask = $user->studentTasks()->create($validated);

        return new StudentTaskResource($studentTask);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', StudentTask::class);
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'score' => ['required', 'numeric']
        ]);
        $studentTask = StudentTask::find($request->studentTask);
        $studentTask->update(['status' => true]);
        $studentTask->update($validated);
        return new StudentTaskResource($studentTask);
    }
}
