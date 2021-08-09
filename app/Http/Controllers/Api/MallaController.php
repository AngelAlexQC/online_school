<?php

namespace App\Http\Controllers\Api;

use App\Models\Malla;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MallaResource;
use App\Http\Resources\MallaCollection;
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
            ->paginate();

        return new MallaCollection($mallas);
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

        return new MallaResource($malla);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Malla $malla)
    {
        $this->authorize('view', $malla);

        return new MallaResource($malla);
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

        return new MallaResource($malla);
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

        return response()->noContent();
    }
}
