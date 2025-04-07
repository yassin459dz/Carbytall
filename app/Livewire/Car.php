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
<<<<<<< HEAD
        // return view('livewire.cars.car', [
        //     'cars' => cars::paginate(100)
        // ]);

        $cars = cars::paginate(10);
        return view('livewire.cars.car', compact('cars'));
=======
        return view('livewire.cars.car', [
            'cars' => cars::paginate(100)
        ]);
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }
    // this for send data to edit page
    public function mount(){

        $this->car = cars::all();
    }

    #[On('refresh-cars')]
    public function refreshCar()
    {
        $this->resetPage(); // This ensures pagination starts on the first page when refreshed
    }
}
