<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Malla;
use App\Models\Admission;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.admissions.index', compact('admissions', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Admission::class);

        $users = User::pluck('first_name', 'id');
        $mallas = Malla::pluck('name', 'id');

        return view('app.admissions.create', compact('users', 'mallas'));
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

        return redirect()
            ->route('admissions.edit', $admission)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admission $admission)
    {
        $this->authorize('view', $admission);

        return view('app.admissions.show', compact('admission'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Admission $admission)
    {
        $this->authorize('update', $admission);

        $users = User::pluck('first_name', 'id');
        $mallas = Malla::pluck('name', 'id');

        return view(
            'app.admissions.edit',
            compact('admission', 'users', 'mallas')
        );
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

        return redirect()
            ->route('admissions.edit', $admission)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('admissions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
