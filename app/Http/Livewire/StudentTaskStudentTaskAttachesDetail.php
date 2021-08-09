<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\StudentTask;
use App\Models\StudentTaskAttach;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentTaskStudentTaskAttachesDetail extends Component
{
    use AuthorizesRequests;

    public StudentTask $studentTask;
    public StudentTaskAttach $studentTaskAttach;
    public $studentTaskComments = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New StudentTaskAttach';

    protected $rules = [
        'studentTaskAttach.attach_id' => ['required', 'exists:comments,id'],
    ];

    public function mount(StudentTask $studentTask)
    {
        $this->studentTask = $studentTask;
        $this->studentTaskComments = Comment::pluck('name', 'id');
        $this->resetStudentTaskAttachData();
    }

    public function resetStudentTaskAttachData()
    {
        $this->studentTaskAttach = new StudentTaskAttach();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStudentTaskAttach()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.student_task_student_task_attaches.new_title'
        );
        $this->resetStudentTaskAttachData();

        $this->showModal();
    }

    public function editStudentTaskAttach(StudentTaskAttach $studentTaskAttach)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.student_task_student_task_attaches.edit_title'
        );
        $this->studentTaskAttach = $studentTaskAttach;

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

        if (!$this->studentTaskAttach->student_task_id) {
            $this->authorize('create', StudentTaskAttach::class);

            $this->studentTaskAttach->student_task_id = $this->studentTask->id;
        } else {
            $this->authorize('update', $this->studentTaskAttach);
        }

        $this->studentTaskAttach->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', StudentTaskAttach::class);

        StudentTaskAttach::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetStudentTaskAttachData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->studentTask->studentTaskAttaches
            as $studentTaskAttach
        ) {
            array_push($this->selected, $studentTaskAttach->id);
        }
    }

    public function render()
    {
        return view('livewire.student-task-student-task-attaches-detail', [
            'studentTaskAttaches' => $this->studentTask
                ->studentTaskAttaches()
                ->paginate(20),
        ]);
    }
}
