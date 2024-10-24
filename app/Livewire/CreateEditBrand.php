<?php

namespace App\Livewire;
use App\Models\brands;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class CreateEditBrand extends Component
{
    public $brand='';

    public function render()
    {
        return view('livewire.brands.create-edit-brand');
    }

    public function save()
    {
        // Validate input
        $validated = $this->validate([
            'brand' => 'required|max:255',
        ]);

        // Save the brand
        Brand::create(['name' => $this->brand]);

        // Flash message for success
        session()->flash('message', 'Brand created successfully!');

        // Reset the form
        $this->reset('brand');
    }
    // public function save(){
    //     $validated=$this->validate();
    //     brands::create($validated);
    //     // $this->dispatch('refresh-brands');
    //     session()->flash('status','Brand created');
    //     $this->reset();
    // }
    // public function save(){
    //          $validated=$this->validate([
    //              'brandtitle'=>'required|max:255',
    //          ]);
    //          brands::create($validated);
    //          // Flash message
    //          session()->flash('message', 'Brand created successfully!');
    //            $this->reset();
    //      }


    //  public function save(){
    //      $validated=$this->validate([
    //          'brand'=>'required|max:255',
    //      ]);

    //      brands::create($validated);
    //      // Flash message
    //      session()->flash('message', 'Brand created successfully!');
    //        $this->reset();
    //     // return redirect()->to('/brand'); // Change this to your actual route
    //     return $this->redirect('/brand', );

    // }

    // //  public function clearform()
    // //  {

    // //      $this->brand = '';

    // //  }
    // #[On('reset-modal')]
    // public function close(){
    //     $this->reset();
    // }
}
