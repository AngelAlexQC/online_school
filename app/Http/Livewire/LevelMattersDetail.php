<?php

namespace App\Http\Livewire;

use App\Models\Level;
use App\Models\Matter;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LevelMattersDetail extends Component
{
    use AuthorizesRequests;

    public Level $level;
    public Matter $matter;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Matter';

    protected $rules = [
        'matter.name' => ['nullable', 'max:255', 'string'],
        'matter.credits' => ['required', 'numeric'],
    ];

    public function mount(Level $level)
    {
        $this->level = $level;
        $this->resetMatterData();
    }

    public function resetMatterData()
    {
        $this->matter = new Matter();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMatter()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.level_matters.new_title');
        $this->resetMatterData();

        $this->showModal();
    }

    public function editMatter(Matter $matter)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.level_matters.edit_title');
        $this->matter = $matter;

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

        if (!$this->matter->level_id) {
            $this->authorize('create', Matter::class);

            $this->matter->level_id = $this->level->id;
        } else {
            $this->authorize('update', $this->matter);
        }

        $this->matter->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Matter::class);

        Matter::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetMatterData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->level->matters as $matter) {
            array_push($this->selected, $matter->id);
        }
    }

    public function render()
    {
        return view('livewire.level-matters-detail', [
            'matters' => $this->level->matters()->paginate(20),
        ]);
    }
}
