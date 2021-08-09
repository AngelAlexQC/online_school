<?php

namespace App\Http\Controllers\Api;

use App\Models\Matter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MatterResource;
use App\Http\Resources\MatterCollection;
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
            ->paginate();

        return new MatterCollection($matters);
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

        return new MatterResource($matter);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Matter $matter)
    {
        $this->authorize('view', $matter);

        return new MatterResource($matter);
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

        return new MatterResource($matter);
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

        return response()->noContent();
    }
}
