<?php

namespace App\Http\Livewire;

use App\Models\Malla;
use App\Models\Level;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MallaLevelsDetail extends Component
{
    use AuthorizesRequests;

    public Malla $malla;
    public Level $level;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Level';

    protected $rules = [
        'level.number' => ['required', 'numeric'],
        'level.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(Malla $malla)
    {
        $this->malla = $malla;
        $this->resetLevelData();
    }

    public function resetLevelData()
    {
        $this->level = new Level();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newLevel()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.malla_levels.new_title');
        $this->resetLevelData();

        $this->showModal();
    }

    public function editLevel(Level $level)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.malla_levels.edit_title');
        $this->level = $level;

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

        if (!$this->level->malla_id) {
            $this->authorize('create', Level::class);

            $this->level->malla_id = $this->malla->id;
        } else {
            $this->authorize('update', $this->level);
        }

        $this->level->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Level::class);

        Level::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetLevelData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->malla->levels as $level) {
            array_push($this->selected, $level->id);
        }
    }

    public function render()
    {
        return view('livewire.malla-levels-detail', [
            'levels' => $this->malla->levels()->paginate(20),
        ]);
    }
}
