<?php

namespace App\Http\Controllers\Api;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CareerResource;
use App\Http\Resources\CareerCollection;
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
            ->paginate();

        return new CareerCollection($careers);
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

        return new CareerResource($career);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Career $career)
    {
        $this->authorize('view', $career);

        return new CareerResource($career);
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

        return new CareerResource($career);
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

        return response()->noContent();
    }
}
