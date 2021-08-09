<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssistancesResource;
use App\Http\Resources\AssistancesCollection;

class CourseClassAllAssistancesController extends Controller
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

        $allAssistances = $courseClass
            ->allAssistances()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssistancesCollection($allAssistances);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseClass $courseClass
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CourseClass $courseClass)
    {
        $this->authorize('create', Assistances::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'student_id' => ['required', 'exists:users,id'],
        ]);

        $assistances = $courseClass->allAssistances()->create($validated);

        return new AssistancesResource($assistances);
    }
}
