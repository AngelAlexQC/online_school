<?php

namespace App\Http\Controllers\Api;

use App\Models\Malla;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionResource;
use App\Http\Resources\AdmissionCollection;

class MallaAdmissionsController extends Controller
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

        $admissions = $malla
            ->admissions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AdmissionCollection($admissions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Malla $malla
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Malla $malla)
    {
        $this->authorize('create', Admission::class);

        $validated = $request->validate([
            'requester_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'max:255', 'string'],
        ]);

        $admission = $malla->admissions()->create($validated);

        return new AdmissionResource($admission);
    }
}
