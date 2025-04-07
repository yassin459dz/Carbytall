<?php

namespace App\Livewire;
use App\Models\Factures;
use App\Models\cars;
use App\Models\matricules;
<<<<<<< HEAD
use Livewire\WithPagination;
=======

>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87

use Livewire\Component;

class ListFacture extends Component
{
<<<<<<< HEAD
    public $status;

    use WithPagination;


    public function render()
    {
        // $this->factures=Factures::all();
        // $this->factures = Factures::with('client')->get();

        // return view('livewire.FACTURE.list-facture');
        $factures = Factures::paginate(10);
        return view('livewire.FACTURE.list-facture', compact('factures'));
=======
    public $factures;
    public $status;


    public function render()
    {
        $this->factures=Factures::all();
        $this->factures = Factures::with('client')->get();

        return view('livewire.FACTURE.list-facture');
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }

}
