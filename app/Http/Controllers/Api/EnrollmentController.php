<?php

namespace App\Http\Controllers\Api;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;
use App\Http\Resources\EnrollmentCollection;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;

class EnrollmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Enrollment::class);

        $search = $request->get('search', '');

        $enrollments = Enrollment::search($search)
            ->latest()
            ->paginate();

        return new EnrollmentCollection($enrollments);
    }

    /**
     * @param \App\Http\Requests\EnrollmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnrollmentStoreRequest $request)
    {
        $this->authorize('create', Enrollment::class);

        $validated = $request->validated();

        $enrollment = Enrollment::create($validated);

        return new EnrollmentResource($enrollment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Enrollment $enrollment)
    {
        $this->authorize('view', $enrollment);

        return new EnrollmentResource($enrollment);
    }

    /**
     * @param \App\Http\Requests\EnrollmentUpdateRequest $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(
        EnrollmentUpdateRequest $request,
        Enrollment $enrollment
    ) {
        $this->authorize('update', $enrollment);

        $validated = $request->validated();

        $enrollment->update($validated);

        return new EnrollmentResource($enrollment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Enrollment $enrollment)
    {
        $this->authorize('delete', $enrollment);

        $enrollment->delete();

        return response()->noContent();
    }
}
