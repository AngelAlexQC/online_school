<?php

namespace App\Http\Controllers\Api;

use App\Models\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionAtachResource;
use App\Http\Resources\AdmissionAtachCollection;

class AdmissionAdmissionAtachesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Admission $admission)
    {
        $this->authorize('view', $admission);

        $search = $request->get('search', '');

        $admissionAtaches = $admission
            ->admissionAtaches()
            ->search($search)
            ->latest()
            ->paginate();

        return new AdmissionAtachCollection($admissionAtaches);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admission $admission)
    {
        $this->authorize('create', AdmissionAtach::class);

        $validated = $request->validate([]);

        $admissionAtach = $admission->admissionAtaches()->create($validated);

        return new AdmissionAtachResource($admissionAtach);
    }
}
