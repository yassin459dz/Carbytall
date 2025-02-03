<?php
namespace App\Livewire;

use App\Models\Factures;
use App\Models\brands;
use App\Models\cars;
use App\Models\clients;
use App\Models\matricules;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;


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
    public $car;
    public $allcars;
    public $car_id;
    public $search = '';
    public $allmat;
    public $matt;
    public $mat_id;
    public $km;
    public $product;
    public $qte;
    public $price;
    public $total;
    public $remark;
    public $mat = '';

    public $orderItems = '[]';
    public $total_amount = 0;
    public $extraCharge = 0;
    public $discountAmount = 0;
    public $selectedClient = null;
    public $selectedMat = null;
    public $selectedCar = null;

    public function render()
    {

        return view('livewire.facture.facture');
    }

    public function mount()
    {

        $this->initializeFactureNumber();
        $this->product = Product::all();
         $this->allmat = matricules::all();

        $this->fetchClients();
        $this->allcars = collect();
        // $this->allmat = collect();
    }


    public function updated($property, $value)
    {
        // When a license plate is selected, update client and car accordingly.
        if ($property === 'selectedMat') {
            $matRecord = matricules::find($value);
            if ($matRecord) {
                // Update the selected client and car based on the chosen mat record.
                $this->selectedClient = $matRecord->client_id;
                $this->selectedCar = $matRecord->car_id;

                // Optionally, you might want to update the cars list.
                // For example, if you want to display only the car that belongs to the mat:
                $this->allcars = cars::where('id', $matRecord->car_id)->get();

                // You could also reinitialize the client list if needed,
                // but often you have a complete list of clients available.
            }
        }

        // (Optional) If the user changes the client manually, update available cars.
        if ($property === 'selectedClient') {
            // Get cars linked to the selected client (using the matricules table as a pivot).
            $carIds = matricules::where('client_id', $value)
                ->pluck('car_id');
            $this->allcars = cars::whereIn('id', $carIds)->get();

            // Reset the car and mat selections.
            $this->selectedCar = null;
            $this->selectedMat = null;
            $this->allmat = collect();
        }

        // (Optional) If the user changes the car manually, update available matricules.
        if ($property === 'selectedCar') {
            $this->allmat = matricules::where('car_id', $value)
                ->where('client_id', $this->selectedClient) // filter by selected client
                ->get();
        }
    }

    

    // public function updatedSelectedMat($value)
    // {
    // $matRecord = matricules::find($value);
    // if ($matRecord)
    //     {
    //     $this->selectedClient = $matRecord->client_id;
    //     $this->selectedCar = $matRecord->car_id;
    //     $this->allcars = cars::where('id', $matRecord->car_id)->get();
    //     }
    // }



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
                'client_id' => 'required',
            ], [
                'client_id.required' => 'Please select a Client',
            ]);
        } elseif ($this->currentstep === 2) {
            $validated = $this->validate([
                'remark' => 'nullable',
            ]);
        } elseif ($this->currentstep === 3) {
            $validated = $this->validate([
                // Validation rules for step 3
            ]);
        }
    }

    public function createMatricule()
    {
        if (!$this->client_id || !$this->car_id || !$this->mat) {
            $this->addError('mat', 'Client and Car must be selected first');
            return null;
        }

        $existingMatricule = matricules::where('mat', $this->mat)
            ->where('client_id', $this->client_id)
            ->where('car_id', $this->car_id)
            ->first();

        if ($existingMatricule) {
            $this->mat_id = $existingMatricule->id;
            return $existingMatricule->id;
        }

        $matricule = matricules::create([
            'client_id' => $this->client_id,
            'car_id' => $this->car_id,
            'mat' => $this->mat,
        ]);

        $this->mat_id = $matricule->id;
        $this->allmat = matricules::all();

        return $matricule->id;
    }

    public function fetchBrands()
    {
        $this->allbrands = brands::all();
    }

    public function fetchClients()
    {
        $this->allclients = clients::all();
    }

    // public function fetchCars()
    // {
    //     $this->allcars = cars::all();
    // }

    public function fetchProduct()
    {
        $this->product = Product::all();
    }

    public function boot()
    {
        $this->allclients = clients::all();
        $this->allbrands = brands::all();
        // $this->allcars = cars::all();
        // $this->allmat = matricules::all();
        $this->product = Product::all();

        if ($this->client_id) {
            $selectedClient = $this->allclients->where('id', $this->client_id)->first();
            if ($selectedClient) {
                $this->search = $selectedClient->name;
            }
        }

        // if ($this->car_id) {
        //     $selectedCar = $this->allcars->where('id', $this->car_id)->first();
        //     if ($selectedCar) {
        //         $this->search = $selectedCar->Model;
        //     }
        // }

        if ($this->mat_id) {
            $selectedMatricule = $this->allmat->where('id', $this->mat_id)->first();
            if ($selectedMatricule) {
                $this->mat = $selectedMatricule->mat;
            }
        }
    }

    public function initializeFactureNumber()
    {
        // Initialize facture number logic
    }






    public function submit()
    {
        $orderItems = json_decode($this->orderItems, true);

        if (empty($orderItems)) {
            session()->flash('error', 'No items in the order');
            return;
        }

        $processedOrderItems = array_map(function($item) {
            return [
                'product_id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'description' => $item['description'] ?? null,
                'quantity' => $item['quantity'] ?? 0,
                'price' => $item['price'] ?? 0,
                'total' => ($item['quantity'] ?? 0) * ($item['price'] ?? 0)
            ];
        }, $orderItems);

        $totalAmount = collect($processedOrderItems)->sum('total') + $this->extraCharge - $this->discountAmount;
        $matricule_id = $this->mat_id ?? $this->createMatricule();

        Factures::create([
            'client_id' => $this->client_id,
            'car_id' => $this->car_id,
            'matricule_id' => $this->mat_id,
            'km' => $this->km,
            'remark' => $this->remark,
            'order_items' => json_encode($processedOrderItems, JSON_THROW_ON_ERROR),
            'total_amount' => $totalAmount,
            'extra_charge' => $this->extraCharge,
            'discount_amount' => $this->discountAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
