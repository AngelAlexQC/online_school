<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admission;
use Livewire\WithFileUploads;
use App\Models\AdmissionAtach;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdmissionAdmissionAtachesDetail extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public Admission $admission;
    public AdmissionAtach $admissionAtach;
    public $admissionAtachFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New AdmissionAtach';

    protected $rules = [
        'admissionAtachFile' => ['nullable', 'file'],
        'admissionAtach.name' => ['required', 'max:255', 'string'],
        'admissionAtach.description' => ['nullable', 'max:255', 'string'],
    ];

    public function mount(Admission $admission)
    {
        $this->admission = $admission;
        $this->resetAdmissionAtachData();
    }

    public function resetAdmissionAtachData()
    {
        $this->admissionAtach = new AdmissionAtach();

        $this->admissionAtachFile = null;

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

        if ($this->admissionAtachFile) {
            $this->admissionAtach->file = $this->admissionAtachFile->store(
                'public'
            );
        }

        $this->admissionAtach->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', AdmissionAtach::class);

        collect($this->selected)->each(function (string $id) {
            $admissionAtach = AdmissionAtach::findOrFail($id);

            if ($admissionAtach->file) {
                Storage::delete($admissionAtach->file);
            }

            $admissionAtach->delete();
        });

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
