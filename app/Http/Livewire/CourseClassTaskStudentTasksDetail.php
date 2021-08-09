<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\StudentTask;
use App\Models\CourseClassTask;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseClassTaskStudentTasksDetail extends Component
{
    use AuthorizesRequests;

    public CourseClassTask $courseClassTask;
    public StudentTask $studentTask;
    public $courseClassTaskUsers = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New StudentTask';

    protected $rules = [
        'studentTask.name' => ['required', 'max:255', 'string'],
        'studentTask.student_id' => ['required', 'exists:users,id'],
    ];

    public function mount(CourseClassTask $courseClassTask)
    {
        $this->courseClassTask = $courseClassTask;
        $this->courseClassTaskUsers = User::pluck('first_name', 'id');
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
        $this->modalTitle = trans(
            'crud.course_class_task_student_tasks.new_title'
        );
        $this->resetStudentTaskData();

        $this->showModal();
    }

    public function editStudentTask(StudentTask $studentTask)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.course_class_task_student_tasks.edit_title'
        );
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

        if (!$this->studentTask->task_id) {
            $this->authorize('create', StudentTask::class);

            $this->studentTask->task_id = $this->courseClassTask->id;
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

        foreach ($this->courseClassTask->studentTasks as $studentTask) {
            array_push($this->selected, $studentTask->id);
        }
    }

    public function render()
    {
        return view('livewire.course-class-task-student-tasks-detail', [
            'studentTasks' => $this->courseClassTask
                ->studentTasks()
                ->paginate(20),
        ]);
    }
}
