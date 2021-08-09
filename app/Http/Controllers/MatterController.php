<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Matter;
use Illuminate\Http\Request;
use App\Http\Requests\MatterStoreRequest;
use App\Http\Requests\MatterUpdateRequest;

class MatterController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Matter::class);

        $search = $request->get('search', '');

        $matters = Matter::search($search)
            ->latest()
            ->paginate(5);

        return view('app.matters.index', compact('matters', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Matter::class);

        $levels = Level::pluck('name', 'id');

        return view('app.matters.create', compact('levels'));
    }

    /**
     * @param \App\Http\Requests\MatterStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatterStoreRequest $request)
    {
        $this->authorize('create', Matter::class);

        $validated = $request->validated();

        $matter = Matter::create($validated);

        return redirect()
            ->route('matters.edit', $matter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Matter $matter)
    {
        $this->authorize('view', $matter);

        return view('app.matters.show', compact('matter'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Matter $matter)
    {
        $this->authorize('update', $matter);

        $levels = Level::pluck('name', 'id');

        return view('app.matters.edit', compact('matter', 'levels'));
    }

    /**
     * @param \App\Http\Requests\MatterUpdateRequest $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function update(MatterUpdateRequest $request, Matter $matter)
    {
        $this->authorize('update', $matter);

        $validated = $request->validated();

        $matter->update($validated);

        return redirect()
            ->route('matters.edit', $matter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Matter $matter)
    {
        $this->authorize('delete', $matter);

        $matter->delete();

        return redirect()
            ->route('matters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
