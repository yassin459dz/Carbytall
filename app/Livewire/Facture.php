<?php

namespace App\Livewire;
use App\Models\Factures;
use App\Models\brands;
use App\Models\cars;
use App\Models\clients;
use Livewire\Component;

class Facture extends Component
{
    public $currentstep = 2;//vs code want to make the S with maj fuck heme
    public $totalstep = 3;//vs code want to make the S with maj fuck heme

    // public $first_name;
    // public $last_name;
    public $email;
    public $phone;
    public $status;
    public $gender;

    public $allbrands;

    public $allclients;

    public $allcars;

    public $car_id; // Add this line


    public function render()
    {
        return view('livewire.facture.facture');
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
                'car_id'     => 'required',
            ], [
                'car_id.required' => 'Please select a Car Model', // Custom error message for car_id
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

        $this->allclients = clients::all(); // Retrieve all brands
        $this->allbrands = brands::all(); // Retrieve all brands
        $this->allcars = cars::all(); // Retrieve all brands


    }
}
