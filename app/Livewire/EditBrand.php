<?php

namespace App\Livewire;
use App\Models\brands;
use Livewire\Component;
use App\livewire\Brand;

class EditBrand extends Component
{
    // public $allbrand;
    // public $brandname;

    // public function mount(brands $allbrand){
    //     $this->allbrand=$allbrand;
    //     $this->brandname=$allbrand->brand;


    // }
    // public function render()
    // {
    //     return view('livewire.brands.edit-brand');
    // }

    // public function update()
    // {
    //     $validated=$this->validate([
    //         // Change 'brand' to 'brandname' to match the public property
    //         'brandname'=>'required|max:255',

    //     ]);
    //     // Update the model with the validated brand name
    //     $this->allbrand->update(['brand' => $validated['brandname']]);
    //     // Use 'brand' as key to match the column name
    //     // Provide a success message
    //     session()->flash('success', 'Brand updated successfully!');

    //     // Redirect back to the brands list
    //      return redirect()->route('brand'); // Use the route name defined in your routes
    //     // return redirect()->route('/brand');

    //     //return $this->redirect('/brand', navigate: true);


    // }
}
