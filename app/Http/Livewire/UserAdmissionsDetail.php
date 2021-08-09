<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Malla;
use Livewire\Component;
use App\Models\Admission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserAdmissionsDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Admission $admission;
    public $userMallas = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Admission';

    protected $rules = [
        'admission.malla_id' => ['required', 'exists:mallas,id'],
        'admission.status' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userMallas = Malla::pluck('name', 'id');
        $this->resetAdmissionData();
    }

    public function resetAdmissionData()
    {
        $this->admission = new Admission();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAdmission()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_admissions.new_title');
        $this->resetAdmissionData();

        $this->showModal();
    }

    public function editAdmission(Admission $admission)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_admissions.edit_title');
        $this->admission = $admission;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->admission->requester_id) {
            $this->authorize('create', Admission::class);

            $this->admission->requester_id = $this->user->id;
        } else {
            $this->authorize('update', $this->admission);
        }

        $this->admission->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Admission::class);

        Admission::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAdmissionData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->admissions as $admission) {
            array_push($this->selected, $admission->id);
        }
    }

    public function render()
    {
        return view('livewire.user-admissions-detail', [
            'admissions' => $this->user->admissions()->paginate(20),
        ]);
    }
}
