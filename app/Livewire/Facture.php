<?php

namespace App\Livewire;
use App\Models\Factures;
use App\Models\brands;
use App\Models\cars;
use App\Models\clients;
use Livewire\Component;

class Facture extends Component
{
    public $currentstep = 2;
    public $totalstep = 3;//vs code want to make the S with maj fuck heme

    // public $first_name;
    // public $last_name;
    public $client_id;

    public $email;
    public $phone;

    public $facture_number;  // Add facture number property

    public $status;
    public $gender;

    public $allbrands;

    public $allclients;

    public $allcars;

    public $car_id; // Add this line

    public $search = ''; // Define $search here


    public function render()
    {
        return view('livewire.facture.facture');
    }
    public function mount()
    {
        // Initialize facture_number
        $this->initializeFactureNumber();

    }

    public function incrementstep(){
        $this->validateForm();
        if($this->currentstep <$this->totalstep)
        {
            $this->currentstep ++;
        }

    }

    public function decrementstep(){
        if($this->currentstep>1){
            $this->currentstep --;
        }
    }

    public function validateForm(){
        if($this->currentstep ===1)
        {
            $validated=$this->validate([
                // 'first_name'=>'required',
                // 'last_name'=>'required',
                'client_id'     => 'required',
                'car_id'     => 'required',
                'facture_number' => 'required',

            ], [
                'car_id.required' => 'Please select a Car Model', // Custom error message for car_id
                'client_id.required' => 'Please select a Client', // Custom error message for car_id

            ]);
        }
        elseif($this->currentstep ===2){
            if($this->currentstep ===2)
            {
                $validated=$this->validate([
                    'email'=>'required',
                    'phone'=>'required',
                ]);
            }
        }

    }

    public function fetchBrands()
    {
        $this->allbrands = brands::all(); // Assuming you're storing brands in this property
    }

    public function fetchClients()
    {
        $this->allclients = clients::all(); // Assuming you're storing brands in this property
    }
    public function fetchCars()
    {
        $this->allcars = cars::all(); // Assuming you're storing brands in this property
    }

    public function boot()
    {
        $this->allclients = clients::all();
        $this->allbrands = brands::all();
        $this->allcars = cars::all();

        // Initialize `$search` with the selected client's name if `client_id` is set
        if ($this->client_id) {
            $selectedClient = $this->allclients->where('id', $this->client_id)->first();
            if ($selectedClient) {
                $this->search = $selectedClient->name;
            }
        }
    }

        // Initialize facture_number to the last facture number + 1
        public function initializeFactureNumber()
        {
            $lastFacture = Factures::latest('id')->first();
            $this->facture_number = $lastFacture ? $lastFacture->facture_number + 1 : 1;  // Start at 1 if none exist
        }

}
