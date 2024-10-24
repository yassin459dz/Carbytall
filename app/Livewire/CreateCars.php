<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\cars;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;


class CreateCars extends Component
{
    #[Rule('required')]
    public $car;
    public function render()
    {
        return view('livewire.cars.create-cars');
    }

    public function save (){
        $validated=$this->validate();
        cars::create($validated);
        // $this->dispatch('refresh-clients');
        session()->flash('status', 'Car Created');
        $this->reset();// ADD THIS TO REFRESH PAGE WITH PHP
    }
}
