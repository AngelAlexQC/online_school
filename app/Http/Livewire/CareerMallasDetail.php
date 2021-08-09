<?php

namespace App\Http\Livewire;

use App\Models\Malla;
use App\Models\Career;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CareerMallasDetail extends Component
{
    use AuthorizesRequests;

    public Career $career;
    public Malla $malla;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Malla';

    protected $rules = [
        'malla.name' => ['required', 'max:255', 'string'],
        'malla.year' => ['required', 'numeric'],
    ];

    public function mount(Career $career)
    {
        $this->career = $career;
        $this->resetMallaData();
    }

    public function resetMallaData()
    {
        $this->malla = new Malla();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMalla()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.career_mallas.new_title');
        $this->resetMallaData();

        $this->showModal();
    }

    public function editMalla(Malla $malla)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.career_mallas.edit_title');
        $this->malla = $malla;

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

        if (!$this->malla->career_id) {
            $this->authorize('create', Malla::class);

            $this->malla->career_id = $this->career->id;
        } else {
            $this->authorize('update', $this->malla);
        }

        $this->malla->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Malla::class);

        Malla::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetMallaData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->career->mallas as $malla) {
            array_push($this->selected, $malla->id);
        }
    }

    public function render()
    {
        return view('livewire.career-mallas-detail', [
            'mallas' => $this->career->mallas()->paginate(20),
        ]);
    }
}
