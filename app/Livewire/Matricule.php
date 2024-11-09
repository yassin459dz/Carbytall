<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\matricules;

class Matricule extends Component
{
    public $matricules;

    public function render()
    {
        return view('livewire.matricule.matricule');
    }

    public function mount(){

        $this->matricules = matricules::all();
    }

    #[On('refresh-matricules')]
    public function refreshCar()
    {
        $this->resetPage(); // This ensures pagination starts on the first page when refreshed
    }

}
