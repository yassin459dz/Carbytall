<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\cars;

class Car extends Component
{
    public $cars;

    public $car;

    public function render()
    {
        return view('livewire.cars.car');
    }

    public function mount(){
        $this->cars = cars::all();

    }

    #[On('refresh-cars')]
    public function refreshClient(){
     $this->cars=cars::all();
    // $this->resetPage();
    }

}
