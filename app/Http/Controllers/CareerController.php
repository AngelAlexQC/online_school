<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Requests\CareerStoreRequest;
use App\Http\Requests\CareerUpdateRequest;

class CareerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Career::class);

        $search = $request->get('search', '');

        $careers = Career::search($search)
            ->latest()
            ->paginate(5);

        return view('app.careers.index', compact('careers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Career::class);

        $schools = School::pluck('name', 'id');

        return view('app.careers.create', compact('schools'));
    }

    /**
     * @param \App\Http\Requests\CareerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerStoreRequest $request)
    {
        $this->authorize('create', Career::class);

        $validated = $request->validated();

        $career = Career::create($validated);

        return redirect()
            ->route('careers.edit', $career)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Career $career)
    {
        $this->authorize('view', $career);

        return view('app.careers.show', compact('career'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Career $career)
    {
        $this->authorize('update', $career);

        $schools = School::pluck('name', 'id');

        return view('app.careers.edit', compact('career', 'schools'));
    }

    /**
     * @param \App\Http\Requests\CareerUpdateRequest $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function update(CareerUpdateRequest $request, Career $career)
    {
        $this->authorize('update', $career);

        $validated = $request->validated();

        $career->update($validated);

        return redirect()
            ->route('careers.edit', $career)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Career $career)
    {
        $this->authorize('delete', $career);

        $career->delete();

        return redirect()
            ->route('careers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
