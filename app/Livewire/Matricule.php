<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\matricules;

class Matricule extends Component
{
    use WithPagination;

    // Removed the public $matricules property from mount()

    public function mount()
    {
        // No need to load matricules here since we're paginating in render()
    }

    public function render()
    {
        // Fetch matricules with pagination (10 per page)
        $matricules = matricules::paginate(10);

        return view('livewire.matricule.matricule', compact('matricules'));
    }

    #[On('refresh-matricules')]
    public function refreshCar()
    {
        $this->resetPage(); // Reset pagination when refreshed
    }
    public function updatingSearch()
{
    $this->resetPage();
}

}
