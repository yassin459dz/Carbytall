<?php
namespace App\Livewire;

use App\Models\Factures;
use App\Models\brands;
use App\Models\cars;
use App\Models\clients;
use App\Models\matricules;
<<<<<<< HEAD
use App\Models\Products;
=======
use App\Models\Product;
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Bl extends Component
{
    public $currentstep = 3;
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


    public function render()
    {
<<<<<<< HEAD
        return view('livewire.Facture.bl');
=======
        return view('livewire.facture.bl');
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }

    public function mount()
    {
        $this->initializeFactureNumber();
<<<<<<< HEAD
        $this->product = Products::all();
=======
        $this->product = Product::all();
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }

    public function fetchProduct()
    {
<<<<<<< HEAD
        $this->product = Products::all();
=======
        $this->product = Product::all();
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }

    public function boot()
    {
<<<<<<< HEAD
        $this->product = Products::all();
=======
        $this->product = Product::all();
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
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

        $totalAmount = collect($processedOrderItems)->sum(callback: 'total') + $this->extraCharge - $this->discountAmount;

        Factures::create([
            'client_id' => 256, // Fixed specific value
            'car_id' => 42 ,
            'matricule_id' => 2,
            'km' => 0,
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
