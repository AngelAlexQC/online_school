<?php

namespace App\Http\Controllers\Api;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodResource;
use App\Http\Resources\PeriodCollection;

class SchoolPeriodsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, School $school)
    {
        $this->authorize('view', $school);

        $search = $request->get('search', '');

        $periods = $school
            ->periods()
            ->search($search)
            ->latest()
            ->paginate();

        return new PeriodCollection($periods);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, School $school)
    {
        $this->authorize('create', Period::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'status' => ['required', 'boolean'],
        ]);

        $period = $school->periods()->create($validated);

        return new PeriodResource($period);
    }
}
