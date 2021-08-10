<?php

namespace App\Http\Controllers\Api;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\SchoolCollection;
use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;

class SchoolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', School::class);

        $search = $request->get('search', '');

        $schools = School::search($search)
            ->latest()
            ->paginate();

        return new SchoolCollection($schools);
    }

    /**
     * @param \App\Http\Requests\SchoolStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolStoreRequest $request)
    {
        $this->authorize('create', School::class);

        $validated = $request->validated();

        $school = School::create($validated);

        return new SchoolResource($school);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, School $school)
    {
        $this->authorize('view', $school);

        return new SchoolResource($school);
    }

    /**
     * @param \App\Http\Requests\SchoolUpdateRequest $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolUpdateRequest $request, School $school)
    {
        $this->authorize('update', $school);

        $validated = $request->validated();

        $school->update($validated);

        return new SchoolResource($school);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, School $school)
    {
        $this->authorize('delete', $school);

        $school->delete();

        return response()->noContent();
    }
}
