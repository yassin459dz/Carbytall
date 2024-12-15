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
    // public $mat;
    public $mat = ''; // Add this to store the selected matricule

    // Existing properties...
    // public $orderItems = [];
    // public $extraCharge = 0;
    // public $discountAmount = 0;
    public $orderItems = '[]';
public $total_amount = 0;
public $extraCharge = 0;
public $discountAmount = 0;

    // Method to add order item dynamically
    public function addOrderItem($productId, $quantity, $price)
    {
        $product = Product::find($productId);

        if ($product) {
            $this->orderItems[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $quantity * $price
            ];
        }
    }

    // Method to remove order item
    // public function removeOrderItem($index)
    // {
    //     unset($this->orderItems[$index]);
    //     $this->orderItems = array_values($this->orderItems);
    // }

    // Calculate total order value
    public function calculateTotal()
    {
        $subtotal = collect($this->orderItems)->sum('total');
        return $subtotal + $this->extraCharge - $this->discountAmount;
    }



    public function render()
    {
        return view('livewire.facture.facture');
    }

    public function mount()
    {
        $this->initializeFactureNumber();
        $this->product = Product::all();

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
                'client_id' => 'required',
                // 'mat_id' => 'required',
                // 'car_id' => 'required',
                 //'fac' => 'required',
            ], [
                'client_id.required' => 'Please select a Client',
                'mat_id.required' => 'Please select a Matricule',
                'car_id.required' => 'Please select a Car Model',

            ]);
        }
        elseif ($this->currentstep === 2) {
            $validated = $this->validate([
                //  'mat' => 'required',
                //  'km' => 'required',
                  'remark' => 'nullable',
                ], [
                    'KM.required' => 'Please Type The KM',
                ]);
        }

        elseif ($this->currentstep === 3) {
            $validated = $this->validate([
                //  'product' => 'required',
                //  'price' => 'required',
                //  'qte' => 'required',
                //  'total' => 'required',

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

    public function fetchProduct()
    {
        $this->product = Product::all();
    }

    public function boot()
    {
        $this->allclients = clients::all();
        $this->allbrands = brands::all();
        $this->allcars = cars::all();
        $this->allmat = matricules::all();
        $this->product = Product::all();


        if ($this->client_id) {
            $selectedClient = $this->allclients->where('id', $this->client_id)->first();
            if ($selectedClient) {
                $this->search = $selectedClient->name;
            }
        }

                // Similar to client selection, set the search value for matricule
                if ($this->mat_id) {
                    $selectedMatricule = $this->allmat->where('id', $this->mat_id)->first();
                    if ($selectedMatricule) {
                        $this->mat = $selectedMatricule->mat; // Assuming 'mat' is the registration number field
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
        $orderItems = json_decode($this->orderItems, true);

        // Validate that order items exist and have the required fields
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
    // Calculate total amount
    $totalAmount = collect($processedOrderItems)->sum('total') + $this->extraCharge - $this->discountAmount;

        // dd($this->all());
// Validate input data

     // Debug the created facture
    //  dd([
    //     'client_id' => $this->client_id,
    //     'car_id' => $this->car_id, // nullable
    //     'matricule_id' => $this->mat_id, // assuming you want to store this
    //     'km' => $this->km,
    //     'remark' => $this->remark,
    //     'order_items' => json_encode($processedOrderItems),
    //     'total_amount' => $totalAmount,
    //     'extra_charge' => $this->extraCharge,
    //     'discount_amount' => $this->discountAmount,
    // ]);
     // Create facture items

            Factures::create([

                'client_id' => $this->client_id,
                'car_id' => $this->car_id, // nullable
                // 'matricule_id' => $this->mat_id, // assuming you want to store this
                'km' => $this->km,
                'remark' => $this->remark,
                'order_items' => json_encode($processedOrderItems, JSON_THROW_ON_ERROR), // Improved JSON encoding

                // 'order_items' => json_encode($processedOrderItems),
                'total_amount' => $totalAmount,
                'extra_charge' => $this->extraCharge,
                'discount_amount' => $this->discountAmount,
                //'facture_number' => $this->fac,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

    }
}
