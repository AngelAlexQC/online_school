<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;

class EnrollmentController extends Controller
{
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
            ->paginate(5);

        return view('app.enrollments.index', compact('enrollments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Enrollment::class);

        $users = User::pluck('first_name', 'id');
        $courses = Course::pluck('name', 'id');

        return view('app.enrollments.create', compact('users', 'courses'));
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

        return redirect()
            ->route('enrollments.edit', $enrollment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Enrollment $enrollment)
    {
        $this->authorize('view', $enrollment);

        return view('app.enrollments.show', compact('enrollment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Enrollment $enrollment)
    {
        $this->authorize('update', $enrollment);

        $users = User::pluck('first_name', 'id');
        $courses = Course::pluck('name', 'id');

        return view(
            'app.enrollments.edit',
            compact('enrollment', 'users', 'courses')
        );
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

        return redirect()
            ->route('enrollments.edit', $enrollment)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('enrollments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
