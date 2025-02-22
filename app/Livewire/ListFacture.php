<?php

namespace App\Livewire;
use App\Models\Factures;
use App\Models\cars;
use App\Models\matricules;


use Livewire\Component;

class ListFacture extends Component
{
    public $factures;
    public $status;


    public function render()
    {
        $this->factures=Factures::all();
        $this->factures = Factures::with('client')->get();

        return view('livewire.FACTURE.list-facture');
    }

}
