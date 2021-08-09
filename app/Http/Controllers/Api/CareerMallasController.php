<?php

namespace App\Http\Controllers\Api;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MallaResource;
use App\Http\Resources\MallaCollection;

class CareerMallasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Career $career)
    {
        $this->authorize('view', $career);

        $search = $request->get('search', '');

        $mallas = $career
            ->mallas()
            ->search($search)
            ->latest()
            ->paginate();

        return new MallaCollection($mallas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Career $career
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Career $career)
    {
        $this->authorize('create', Malla::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'year' => ['required', 'numeric'],
        ]);

        $malla = $career->mallas()->create($validated);

        return new MallaResource($malla);
    }
}
