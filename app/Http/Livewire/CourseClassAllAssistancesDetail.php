<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\CourseClass;
use App\Models\Assistances;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseClassAllAssistancesDetail extends Component
{
    use AuthorizesRequests;

    public CourseClass $courseClass;
    public Assistances $assistances;
    public $courseClassUsers = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Assistances';

    protected $rules = [
        'assistances.name' => ['required', 'max:255', 'string'],
        'assistances.student_id' => ['required', 'exists:users,id'],
    ];

    public function mount(CourseClass $courseClass)
    {
        $this->courseClass = $courseClass;
        $this->courseClassUsers = User::pluck('first_name', 'id');
        $this->resetAssistancesData();
    }

    public function resetAssistancesData()
    {
        $this->assistances = new Assistances();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAssistances()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.course_class_all_assistances.new_title'
        );
        $this->resetAssistancesData();

        $this->showModal();
    }

    public function editAssistances(Assistances $assistances)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.course_class_all_assistances.edit_title'
        );
        $this->assistances = $assistances;

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

        if (!$this->assistances->course_class_id) {
            $this->authorize('create', Assistances::class);

            $this->assistances->course_class_id = $this->courseClass->id;
        } else {
            $this->authorize('update', $this->assistances);
        }

        $this->assistances->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Assistances::class);

        Assistances::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAssistancesData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->courseClass->allAssistances as $assistances) {
            array_push($this->selected, $assistances->id);
        }
    }

    public function render()
    {
        return view('livewire.course-class-all-assistances-detail', [
            'allAssistances' => $this->courseClass
                ->allAssistances()
                ->paginate(20),
        ]);
    }
}
