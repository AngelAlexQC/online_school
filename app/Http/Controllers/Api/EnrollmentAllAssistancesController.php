<?php

namespace App\Http\Controllers\Api;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssistancesResource;
use App\Http\Resources\AssistancesCollection;

class EnrollmentAllAssistancesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Enrollment $enrollment)
    {
        $this->authorize('view', $enrollment);

        $search = $request->get('search', '');

        $allAssistances = $enrollment
            ->allAssistances()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssistancesCollection($allAssistances);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Enrollment $enrollment)
    {
        $this->authorize('create', Assistances::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $assistances = $enrollment->allAssistances()->create($validated);

        return new AssistancesResource($assistances);
    }
}
