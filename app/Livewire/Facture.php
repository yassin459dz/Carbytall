<?php
namespace App\Livewire;

use App\Models\Factures;
use App\Models\brands;
use App\Models\cars;
use App\Models\clients;
use Livewire\Component;

class Facture extends Component
{
    public $currentstep = 1;
    public $totalstep = 3;

    public $client_id;
    public $email;
    public $phone;
    public $fac;
    public $status;
    public $gender;
    public $allbrands;
    public $allclients;
    public $allcars;
    public $car_id;
    public $search = '';
    public $mat;
    public $km;
    public $product;
    public $qte;
    public $price;
    public $total;

    public $car;



    public function render()
    {
        return view('livewire.facture.facture');
    }

    public function mount()
    {
        $this->initializeFactureNumber();
    }

    public function incrementstep()
    {
        $this->validateForm();
        if ($this->currentstep < $this->totalstep) {
            $this->currentstep++;
        }
    }

    public function decrementstep()
    {
        if ($this->currentstep > 1) {
            $this->currentstep--;
        }
    }

    public function validateForm()
    {
        if ($this->currentstep === 1) {
            $validated = $this->validate([
                // 'client_id' => 'required',
                'car_id' => 'required',
                 //'fac' => 'required',
            ], [
                'car_id.required' => 'Please select a Car Model',
                'client_id.required' => 'Please select a Client',
            ]);
        }
        elseif ($this->currentstep === 2) {
            $validated = $this->validate([
                 'mat' => 'required',
                 'km' => 'required',
            ]);
        }

        elseif ($this->currentstep === 3) {
            $validated = $this->validate([
                 'product' => 'required',
                 'price' => 'required',
                 'qte' => 'required',
                 'total' => 'required',

            ]);
        }
    }

    public function fetchBrands()
    {
        $this->allbrands = brands::all();
    }

    public function fetchClients()
    {
        $this->allclients = clients::all();
    }

    public function fetchCars()
    {
        $this->allcars = cars::all();
    }

    public function boot()
    {
        $this->allclients = clients::all();
        $this->allbrands = brands::all();
        $this->allcars = cars::all();

        if ($this->client_id) {
            $selectedClient = $this->allclients->where('id', $this->client_id)->first();
            if ($selectedClient) {
                $this->search = $selectedClient->name;
            }
        }
    }

    public function initializeFactureNumber()
    {
        // $lastFacture = Factures::latest('id')->first();
        // $this->facture_number = $lastFacture ? $lastFacture->facture_number + 1 : 1;
    }

    // Add this method for form submission with dd() for debugging
    public function submit()
    {
        // dd($this->all());

            Factures::create([
                'mat' => $this->mat,
                'km' => $this->km,
                'client_id' => $this->client_id,
                'car_id' => $this->car_id,
                'product' => $this->product,
                'price' => $this->price,
                'qte' => $this->qte,
                'total' => $this->total,
                //'facture_number' => $this->fac,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

    }
}
