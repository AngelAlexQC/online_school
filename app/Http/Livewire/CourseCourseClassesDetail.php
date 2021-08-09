<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use App\Models\CourseClass;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseCourseClassesDetail extends Component
{
    use AuthorizesRequests;

    public Course $course;
    public CourseClass $courseClass;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CourseClass';

    protected $rules = [
        'courseClass.name' => ['required', 'max:255', 'string'],
        'courseClass.description' => ['required', 'max:255', 'string'],
        'courseClass.content' => ['required', 'max:255', 'string'],
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->resetCourseClassData();
    }

    public function resetCourseClassData()
    {
        $this->courseClass = new CourseClass();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCourseClass()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.course_course_classes.new_title');
        $this->resetCourseClassData();

        $this->showModal();
    }

    public function editCourseClass(CourseClass $courseClass)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.course_course_classes.edit_title');
        $this->courseClass = $courseClass;

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

        if (!$this->courseClass->course_id) {
            $this->authorize('create', CourseClass::class);

            $this->courseClass->course_id = $this->course->id;
        } else {
            $this->authorize('update', $this->courseClass);
        }

        $this->courseClass->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', CourseClass::class);

        CourseClass::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCourseClassData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->course->courseClasses as $courseClass) {
            array_push($this->selected, $courseClass->id);
        }
    }

    public function render()
    {
        return view('livewire.course-course-classes-detail', [
            'courseClasses' => $this->course->courseClasses()->paginate(20),
        ]);
    }
}
