<?php

namespace App\Livewire;

use App\Models\Factures;
use Livewire\Component;
use App\Models\matricules;
class History extends Component
{
    public $clientId;
    public $carId;
    public $matId;


    public function mount($clientId, $matId, $carId)
    {
        $this->clientId = $clientId;
        $this->matId = $matId;
        $this->carId = $carId;
    }


    public function render()
    {
        // Get matricule details
        $matricule = matricules::with(['client', 'car'])->find($this->matId);

        // Get factures filtered by client and matricule
        $factures = Factures::with(['client', 'car', 'matricule'])
            ->where('client_id', $this->clientId)
            ->where('matricule_id', $this->matId)
            ->get();

        return view('livewire.history', [
            'factures' => $factures,
            'matricule' => $matricule, // Pass matricule to the view
        ]);
    }
}

