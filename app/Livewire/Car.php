<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\cars;

class Car extends Component
{
    use WithPagination;

    public $car;

    public function render()
    {
        return view('livewire.cars.car', [
            'cars' => cars::paginate(100)
        ]);
    }

    #[On('refresh-cars')]
    public function refreshCar()
    {
        $this->resetPage(); // This ensures pagination starts on the first page when refreshed
    }
}
