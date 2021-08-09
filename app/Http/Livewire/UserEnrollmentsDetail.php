<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\Enrollment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserEnrollmentsDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Enrollment $enrollment;
    public $userCourses = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Enrollment';

    protected $rules = [
        'enrollment.course_id' => ['required', 'exists:courses,id'],
        'enrollment.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userCourses = Course::pluck('name', 'id');
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
        $this->modalTitle = trans('crud.user_enrollments.new_title');
        $this->resetEnrollmentData();

        $this->showModal();
    }

    public function editEnrollment(Enrollment $enrollment)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_enrollments.edit_title');
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

        if (!$this->enrollment->student_id) {
            $this->authorize('create', Enrollment::class);

            $this->enrollment->student_id = $this->user->id;
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

        foreach ($this->user->enrollments as $enrollment) {
            array_push($this->selected, $enrollment->id);
        }
    }

    public function render()
    {
        return view('livewire.user-enrollments-detail', [
            'enrollments' => $this->user->enrollments()->paginate(20),
        ]);
    }
}
