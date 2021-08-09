<?php

namespace App\Http\Livewire;

use App\Models\Matter;
use App\Models\Course;
use App\Models\Period;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MatterCoursesDetail extends Component
{
    use AuthorizesRequests;

    public Matter $matter;
    public Course $course;
    public $matterPeriods = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Course';

    protected $rules = [
        'course.period_id' => ['required', 'exists:periods,id'],
        'course.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(Matter $matter)
    {
        $this->matter = $matter;
        $this->matterPeriods = Period::pluck('name', 'id');
        $this->resetCourseData();
    }

    public function resetCourseData()
    {
        $this->course = new Course();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCourse()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.matter_courses.new_title');
        $this->resetCourseData();

        $this->showModal();
    }

    public function editCourse(Course $course)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.matter_courses.edit_title');
        $this->course = $course;

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

        if (!$this->course->matter_id) {
            $this->authorize('create', Course::class);

            $this->course->matter_id = $this->matter->id;
        } else {
            $this->authorize('update', $this->course);
        }

        $this->course->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Course::class);

        Course::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCourseData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->matter->courses as $course) {
            array_push($this->selected, $course->id);
        }
    }

    public function render()
    {
        return view('livewire.matter-courses-detail', [
            'courses' => $this->matter->courses()->paginate(20),
        ]);
    }
}
