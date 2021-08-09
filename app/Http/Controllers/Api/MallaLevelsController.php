<?php

namespace App\Http\Controllers\Api;

use App\Models\Malla;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Http\Resources\LevelCollection;

class MallaLevelsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Malla $malla)
    {
        $this->authorize('view', $malla);

        $search = $request->get('search', '');

        $levels = $malla
            ->levels()
            ->search($search)
            ->latest()
            ->paginate();

        return new LevelCollection($levels);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Malla $malla)
    {
        $this->authorize('create', Level::class);

        $validated = $request->validate([
            'number' => ['required', 'numeric'],
            'name' => ['required', 'max:255', 'string'],
        ]);

        $level = $malla->levels()->create($validated);

        return new LevelResource($level);
    }
}
