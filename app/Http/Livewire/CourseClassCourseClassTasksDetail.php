<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CourseClass;
use Livewire\WithFileUploads;
use App\Models\CourseClassTask;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseClassCourseClassTasksDetail extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public CourseClass $courseClass;
    public CourseClassTask $courseClassTask;
    public $courseClassTaskFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CourseClassTask';

    protected $rules = [
        'courseClassTask.name' => ['nullable', 'max:255', 'string'],
        'courseClassTask.content' => ['required', 'max:255', 'string'],
        'courseClassTaskFile' => ['nullable', 'file'],
        'courseClassTask.score' => ['required', 'numeric'],
    ];

    public function mount(CourseClass $courseClass)
    {
        $this->courseClass = $courseClass;
        $this->resetCourseClassTaskData();
    }

    public function resetCourseClassTaskData()
    {
        $this->courseClassTask = new CourseClassTask();

        $this->courseClassTaskFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCourseClassTask()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.course_class_course_class_tasks.new_title'
        );
        $this->resetCourseClassTaskData();

        $this->showModal();
    }

    public function editCourseClassTask(CourseClassTask $courseClassTask)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.course_class_course_class_tasks.edit_title'
        );
        $this->courseClassTask = $courseClassTask;

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

        if (!$this->courseClassTask->course_class_id) {
            $this->authorize('create', CourseClassTask::class);

            $this->courseClassTask->course_class_id = $this->courseClass->id;
        } else {
            $this->authorize('update', $this->courseClassTask);
        }

        if ($this->courseClassTaskFile) {
            $this->courseClassTask->file = $this->courseClassTaskFile->store(
                'public'
            );
        }

        $this->courseClassTask->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', CourseClassTask::class);

        collect($this->selected)->each(function (string $id) {
            $courseClassTask = CourseClassTask::findOrFail($id);

            if ($courseClassTask->file) {
                Storage::delete($courseClassTask->file);
            }

            $courseClassTask->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCourseClassTaskData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->courseClass->courseClassTasks as $courseClassTask) {
            array_push($this->selected, $courseClassTask->id);
        }
    }

    public function render()
    {
        return view('livewire.course-class-course-class-tasks-detail', [
            'courseClassTasks' => $this->courseClass
                ->courseClassTasks()
                ->paginate(20),
        ]);
    }
}
