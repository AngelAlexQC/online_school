<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\StudentTask;
use App\Models\CourseClassTask;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserStudentTasksDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public StudentTask $studentTask;
    public $userCourseClassTasks = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New StudentTask';

    protected $rules = [
        'studentTask.task_id' => ['required', 'exists:course_class_tasks,id'],
        'studentTask.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userCourseClassTasks = CourseClassTask::pluck('name', 'id');
        $this->resetStudentTaskData();
    }

    public function resetStudentTaskData()
    {
        $this->studentTask = new StudentTask();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStudentTask()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_student_tasks.new_title');
        $this->resetStudentTaskData();

        $this->showModal();
    }

    public function editStudentTask(StudentTask $studentTask)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_student_tasks.edit_title');
        $this->studentTask = $studentTask;

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

        if (!$this->studentTask->student_id) {
            $this->authorize('create', StudentTask::class);

            $this->studentTask->student_id = $this->user->id;
        } else {
            $this->authorize('update', $this->studentTask);
        }

        $this->studentTask->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', StudentTask::class);

        StudentTask::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetStudentTaskData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->studentTasks as $studentTask) {
            array_push($this->selected, $studentTask->id);
        }
    }

    public function render()
    {
        return view('livewire.user-student-tasks-detail', [
            'studentTasks' => $this->user->studentTasks()->paginate(20),
        ]);
    }
}
