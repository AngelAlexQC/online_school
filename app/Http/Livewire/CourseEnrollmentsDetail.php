<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\Enrollment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseEnrollmentsDetail extends Component
{
    use AuthorizesRequests;

    public Course $course;
    public Enrollment $enrollment;
    public $courseUsers = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Enrollment';

    protected $rules = [
        'enrollment.student_id' => ['required', 'exists:users,id'],
        'enrollment.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->courseUsers = User::pluck('first_name', 'id');
        $this->resetEnrollmentData();
    }

    public function resetEnrollmentData()
    {
        $this->enrollment = new Enrollment();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEnrollment()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.course_enrollments.new_title');
        $this->resetEnrollmentData();

        $this->showModal();
    }

    public function editEnrollment(Enrollment $enrollment)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.course_enrollments.edit_title');
        $this->enrollment = $enrollment;

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

        if (!$this->enrollment->course_id) {
            $this->authorize('create', Enrollment::class);

            $this->enrollment->course_id = $this->course->id;
        } else {
            $this->authorize('update', $this->enrollment);
        }

        $this->enrollment->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Enrollment::class);

        Enrollment::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEnrollmentData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->course->enrollments as $enrollment) {
            array_push($this->selected, $enrollment->id);
        }
    }

    public function render()
    {
        return view('livewire.course-enrollments-detail', [
            'enrollments' => $this->course->enrollments()->paginate(20),
        ]);
    }
}
