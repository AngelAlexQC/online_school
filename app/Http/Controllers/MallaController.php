<?php

namespace App\Http\Controllers;

use App\Models\Malla;
use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Requests\MallaStoreRequest;
use App\Http\Requests\MallaUpdateRequest;

class MallaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Malla::class);

        $search = $request->get('search', '');

        $mallas = Malla::search($search)
            ->latest()
            ->paginate(5);

        return view('app.mallas.index', compact('mallas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Malla::class);

        $careers = Career::pluck('name', 'id');

        return view('app.mallas.create', compact('careers'));
    }

    /**
     * @param \App\Http\Requests\MallaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MallaStoreRequest $request)
    {
        $this->authorize('create', Malla::class);

        $validated = $request->validated();

        $malla = Malla::create($validated);

        return redirect()
            ->route('mallas.edit', $malla)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Malla $malla)
    {
        $this->authorize('view', $malla);

        return view('app.mallas.show', compact('malla'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Malla $malla)
    {
        $this->authorize('update', $malla);

        $careers = Career::pluck('name', 'id');

        return view('app.mallas.edit', compact('malla', 'careers'));
    }

    /**
     * @param \App\Http\Requests\MallaUpdateRequest $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function update(MallaUpdateRequest $request, Malla $malla)
    {
        $this->authorize('update', $malla);

        $validated = $request->validated();

        $malla->update($validated);

        return redirect()
            ->route('mallas.edit', $malla)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Malla $malla)
    {
        $this->authorize('delete', $malla);

        $malla->delete();

        return redirect()
            ->route('mallas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
