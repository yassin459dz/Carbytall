<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\cars;

class Car extends Component
{
    public $cars;
    public function mount(){
        $this->cars = cars::all();

    }
    public function render()
    {
        return view('livewire.cars.car');
    }
}
