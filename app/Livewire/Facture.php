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

        $groupedCars = $this->getGroupedCarsProperty();
        return view('livewire.Facture.facture', compact('groupedCars'));    }

    public function mount()
    {

        $this->initializeFactureNumber();
        $this->product = Product::all();
         $this->allmat = matricules::all();

        $this->fetchClients();
        $this->allcars = collect();
        // $this->allmat = collect();
        $this->allcars = cars::all();
    }

    public function getGroupedCarsProperty(): array
    {
        // Get IDs of cars associated with the selected client, if any.
        $ownedCarIds = $this->selectedClient
            ? matricules::where('client_id', $this->selectedClient)
                ->pluck('car_id')
                ->toArray()
            : [];

        // Filter the complete list into two groups.
        $ownedCars = $this->allcars->filter(function ($car) use ($ownedCarIds) {
            return in_array($car->id, $ownedCarIds);
        });

        $nonOwnedCars = $this->allcars->filter(function ($car) use ($ownedCarIds) {
            return !in_array($car->id, $ownedCarIds);
        });

        return [
            'Owned Car'     => $ownedCars,
            'Non Owned Car' => $nonOwnedCars,
        ];
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

        //         // Optionally, you might want to update the cars list.
        //         // For example, if you want to display only the car that belongs to the mat:
        //         $this->allcars = cars::where('id', $matRecord->car_id)->get();

        //         // You could also reinitialize the client list if needed,
        //         // but often you have a complete list of clients available.
             }
         }

            // Reset the car and mat selections.
            // $this->allmat = collect();

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

    public function createMatricule($matNumber)
    {
        // Ensure required selections are made
        if (empty($this->selectedClient) || empty($this->selectedCar) || empty($matNumber)) {
            $this->addError('mat', 'Client, Car, and Matricule are required.');
            return;
        }

        // Check if the Matricule already exists
        $existingMatricule = Matricules::where('mat', $matNumber)
            ->where('client_id', $this->selectedClient)
            ->where('car_id', $this->selectedCar)
            ->first();

        if ($existingMatricule) {
            $this->selectedMat = $existingMatricule->id;
            return;
        }

        // Create a new Matricule
        $matricule = Matricules::create([
            'client_id' => $this->selectedClient,
            'car_id' => $this->selectedCar,
            'mat' => $matNumber,
        ]);

        // Ensure the list updates correctly
        $this->allmat = Matricules::where('car_id', $this->selectedCar)
            ->where('client_id', $this->selectedClient)
            ->get();

        // Set the newly created Matricule as selected
        $this->selectedMat = $matricule->id;

        // Notify frontend (Alpine.js) of updates
        $this->dispatch('matriculeCreated', ['id' => $matricule->id, 'mat' => $matricule->mat]);

        return;
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
        // $matricule_id = $this->mat_id ?? $this->createMatricule();

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
