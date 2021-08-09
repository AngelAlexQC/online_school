<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Admission;
use App\Models\AdmissionAtach;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdmissionAdmissionAtachesDetail extends Component
{
    use AuthorizesRequests;

    public Admission $admission;
    public AdmissionAtach $admissionAtach;
    public $admissionComments = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New AdmissionAtach';

    protected $rules = [
        'admissionAtach.attach_id' => ['required', 'exists:comments,id'],
    ];

    public function mount(Admission $admission)
    {
        $this->admission = $admission;
        $this->admissionComments = Comment::pluck('name', 'id');
        $this->resetAdmissionAtachData();
    }

    public function resetAdmissionAtachData()
    {
        $this->admissionAtach = new AdmissionAtach();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAdmissionAtach()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.admission_admission_ataches.new_title');
        $this->resetAdmissionAtachData();

        $this->showModal();
    }

    public function editAdmissionAtach(AdmissionAtach $admissionAtach)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.admission_admission_ataches.edit_title'
        );
        $this->admissionAtach = $admissionAtach;

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

        if (!$this->admissionAtach->admission_id) {
            $this->authorize('create', AdmissionAtach::class);

            $this->admissionAtach->admission_id = $this->admission->id;
        } else {
            $this->authorize('update', $this->admissionAtach);
        }

        $this->admissionAtach->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', AdmissionAtach::class);

        AdmissionAtach::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAdmissionAtachData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->admission->admissionAtaches as $admissionAtach) {
            array_push($this->selected, $admissionAtach->id);
        }
    }

    public function render()
    {
        return view('livewire.admission-admission-ataches-detail', [
            'admissionAtaches' => $this->admission
                ->admissionAtaches()
                ->paginate(20),
        ]);
    }
}
