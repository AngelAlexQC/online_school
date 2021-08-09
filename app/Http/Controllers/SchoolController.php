<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;

class SchoolController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', School::class);

        $search = $request->get('search', '');

        $schools = School::search($search)
            ->latest()
            ->paginate(5);

        return view('app.schools.index', compact('schools', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', School::class);

        return view('app.schools.create');
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

        return redirect()
            ->route('schools.edit', $school)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, School $school)
    {
        $this->authorize('view', $school);

        return view('app.schools.show', compact('school'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, School $school)
    {
        $this->authorize('update', $school);

        return view('app.schools.edit', compact('school'));
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

        return redirect()
            ->route('schools.edit', $school)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('schools.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
