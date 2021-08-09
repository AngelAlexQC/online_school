<?php

namespace App\Http\Controllers\Api;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CareerResource;
use App\Http\Resources\CareerCollection;

class SchoolCareersController extends Controller
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

        $careers = $school
            ->careers()
            ->search($search)
            ->latest()
            ->paginate();

        return new CareerCollection($careers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, School $school)
    {
        $this->authorize('create', Career::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $career = $school->careers()->create($validated);

        return new CareerResource($career);
    }
}
