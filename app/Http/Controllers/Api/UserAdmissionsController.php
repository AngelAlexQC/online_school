<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionResource;
use App\Http\Resources\AdmissionCollection;

class UserAdmissionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $admissions = $user
            ->admissions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AdmissionCollection($admissions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Admission::class);

        $validated = $request->validate([
            'malla_id' => ['required', 'exists:mallas,id'],
            'status' => ['required', 'max:255', 'string'],
        ]);

        $admission = $user->admissions()->create($validated);

        return new AdmissionResource($admission);
    }
}
