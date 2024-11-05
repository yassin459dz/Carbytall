<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\cars;
use App\Models\brands;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;


class CreateCar extends Component
{

    public $allbrands;
    public $formtitle = 'Create Car';
    public $editform = false;

    public $brandform = false;

    public $carss;

    // #[Rule('required')]
     public $brand_id;  // Added property

    // #[Rule('required')]
     public $model;

    // #[Rule('nullable')]
     public $brand;  // Added property

    // #[Rule('nullable')]
    public $image;

    public function boot()
    {
        // $this->allbrands = cars::all();
        // $this->allbrands = cars::with('brand')->get(); // Use "brand" instead of "brands"
        $this->allbrands = brands::all(); // Retrieve all brands

    }

    public function render()
    {
        return view('livewire.cars.create-car');
    }

    public function save()
    {
    // Try To Validate With Array
    $validated = $this->validate(
        [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|string|max:255',
        ]);
     cars::create([
         'brand_id' => $this->brand_id,
         'model' => $this->model,

    ]);

    // Clear form fields and dispatch events
    session()->flash('status-updated', 'Car created successfully!');
    $this->dispatch('refresh-cars');
    $this->close(); // Reset fields

    // Redirect or close modal if needed
    $this->dispatch('browser', 'close-modal');
    return $this->redirect('/car', navigate: true);

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
        $this->formtitle = 'Edit Client';
        $this->carss = Cars::findOrFail($id);
        $this->brand_id = $this->carss->brand_id;  // Set brand_id for edit
        $this->model = $this->carss->model;
    }

    #[On('brand-mode')]
    public function addbrand()
    {
        $this->brandform = true;
        $this->formtitle = 'Create Brand';


    }


    public function submit (){
        $validated = $this->validate(
            [
                'brand' => 'required|string|max:255',
                'image' => 'required|string|max:255',
            ]);
            brands::create([
             'brand' => $this->brand,
             'image' => $this->image,

        ]);
        $this->brandform = false;
        $this->fetchBrands(); // Call a method to refresh brands

        //$this->reset();

         //$this->dispatch('refresh-cars');
        // session()->flash('status', 'Client Created');
        // session()->flash('status-created', 'Client Created');
        // $this->close();// ADD THIS TO REFRESH PAGE WITH PHP
        //$this->dispatch('browser', 'close-modal');
    }

    // Method to fetch all brands
    public function fetchBrands()
    {
        $this->allbrands = brands::all(); // Assuming you're storing brands in this property
    }
    public function update()
    {
        $validated = $this->validate();
        $p = Cars::findOrFail($this->carss->id);
        $p->update($validated);
        $this->dispatch('refresh-cars');
        session()->flash('status-updated', 'Car Updated');
        $this->dispatch('browser', 'close-modal');
    }

    public function refreshPage()
    {
        // Any logic you want to run before refresh (optional)

        // Redirect to the same route to refresh the page
        return $this->redirect('/car', navigate:true);

    }
}
