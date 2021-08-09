<?php

namespace App\Http\Livewire;

use App\Models\School;
use App\Models\Period;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SchoolPeriodsDetail extends Component
{
    use AuthorizesRequests;

    public School $school;
    public Period $period;
    public $periodStartDate;
    public $periodEndDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Period';

    protected $rules = [
        'period.name' => ['required', 'max:255', 'string'],
        'periodStartDate' => ['required', 'date'],
        'periodEndDate' => ['nullable', 'date'],
        'period.status' => ['required', 'boolean'],
    ];

    public function mount(School $school)
    {
        $this->school = $school;
        $this->resetPeriodData();
    }

    public function resetPeriodData()
    {
        $this->period = new Period();

        $this->periodStartDate = null;
        $this->periodEndDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPeriod()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.school_periods.new_title');
        $this->resetPeriodData();

        $this->showModal();
    }

    public function editPeriod(Period $period)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.school_periods.edit_title');
        $this->period = $period;

        $this->periodStartDate = $this->period->start_date->format('Y-m-d');
        $this->periodEndDate = $this->period->end_date->format('Y-m-d');

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

        if (!$this->period->school_id) {
            $this->authorize('create', Period::class);

            $this->period->school_id = $this->school->id;
        } else {
            $this->authorize('update', $this->period);
        }

        $this->period->start_date = \Carbon\Carbon::parse(
            $this->periodStartDate
        );
        $this->period->end_date = \Carbon\Carbon::parse($this->periodEndDate);

        $this->period->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Period::class);

        Period::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPeriodData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->school->periods as $period) {
            array_push($this->selected, $period->id);
        }
    }

    public function render()
    {
        return view('livewire.school-periods-detail', [
            'periods' => $this->school->periods()->paginate(20),
        ]);
    }
}
