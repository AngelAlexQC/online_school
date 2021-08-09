<?php

namespace App\Http\Controllers\Api;

use App\Models\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionResource;
use App\Http\Resources\AdmissionCollection;
use App\Http\Requests\AdmissionStoreRequest;
use App\Http\Requests\AdmissionUpdateRequest;

class AdmissionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Admission::class);

        $search = $request->get('search', '');

        $admissions = Admission::search($search)
            ->latest()
            ->paginate();

        return new AdmissionCollection($admissions);
    }

    /**
     * @param \App\Http\Requests\AdmissionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdmissionStoreRequest $request)
    {
        $this->authorize('create', Admission::class);

        $validated = $request->validated();

        $admission = Admission::create($validated);

        return new AdmissionResource($admission);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admission $admission)
    {
        $this->authorize('view', $admission);

        return new AdmissionResource($admission);
    }

    /**
     * @param \App\Http\Requests\AdmissionUpdateRequest $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function update(
        AdmissionUpdateRequest $request,
        Admission $admission
    ) {
        $this->authorize('update', $admission);

        $validated = $request->validated();

        $admission->update($validated);

        return new AdmissionResource($admission);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Admission $admission)
    {
        $this->authorize('delete', $admission);

        $admission->delete();

        return response()->noContent();
    }
}
