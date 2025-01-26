<?php

namespace App\Livewire;
use App\Models\Factures;
use App\Models\cars;


use Livewire\Component;

class ListFacture extends Component
{
    public $factures;
    public $status;

    public function render()
    {
        $this->factures=Factures::all();

        return view('livewire.ALL FACTURE.list-facture');
    }

}
