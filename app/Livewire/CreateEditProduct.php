<?php

namespace App\Livewire;
use App\Models\Products;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class CreateEditProduct extends Component
{
    public $formtitle='New Product';
    public $editform=false;
    public $viewform=false;


    public $productss;

    #[Rule('required')]
    public $product;
    public $name;
    public $description;
    public $price;
    public $product_id;


    public function render()
    {
        return view('livewire.products.create-edit-product');
    }
    public function save()
    {
    // Try To Validate With Array

     Products::create([
         'name' => $this->name,
         'description' => $this->description,
         'price' => $this->price,

    ]);
    // $this->dispatch('refresh-products');
    // $this->close(); // Reset fields

    // Redirect or close modal if needed
    // $this->dispatch('browser', 'close-modal');
    // return $this->redirect('/product', navigate: true);
    return $this->redirect(request()->header('Referer'), navigate: true);

    session()->flash('status-created', 'Product created successfully!');

    // public function save (){
    //     $validated=$this->validate();
    //     Products::create($validated);
        // $this->dispatch('refresh-products');
        // dd();
        // session()->flash('status', 'Client Created');
        // session()->flash('status-created', 'Client Created');
        // $this->close();// ADD THIS TO REFRESH PAGE WITH PHP
        // $this->dispatch('browser', 'close-modal');
        // return $this->redirect('/product', navigate:true);
     }



    #[On('reset-modal')]
    public function close()
    {
        $this->reset();
    }

    #[On('edit-mode')]
    public function edit($id)
    {
        $this->editform = true;
        $this->formtitle = 'Edit Product';
        $this->productss =Products::findOrFail($id); // Fetch the car data by ID
        $this->name = $this->productss->name;
        $this->description = $this->productss->description;
        $this->price = $this->productss->price;
        $this->product_id = $id;  // Store the ID for use in the update
    }
    #[On('view-mode')]
    public function view($id)
    {
        $this->viewform = true;
        $this->formtitle = 'View Product';
        $this->productss =Products::findOrFail($id); // Fetch the car data by ID
        $this->name = $this->productss->name;
        $this->description = $this->productss->description;
        $this->price = $this->productss->price;
        $this->product_id = $id;  // Store the ID for use in the update
    }

    public function update()
    {
    // Validate the incoming request data
        // Validate the incoming request data
        // Validate input data (you can add more validation rules as needed)
        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        // Find the car entry by ID and update it with the new data
        $product = Products::findOrFail($this->product_id);
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;

        // Save the changes to the database
        $product->save();
        //  reset the form  after updating
        $this->dispatch('refresh-cars');
        //success message or perform other actions
        session()->flash('status-updated', 'Product Updated');
        $this->dispatch('browser', 'close-modal');
    }
    public function refreshPage()
    {
        $url = request()->header('Referer') ?? url()->current();
        return $this->redirect($url, navigate: true);
    }
}
