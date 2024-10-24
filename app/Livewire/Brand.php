<?php

namespace App\Livewire;
use App\Models\brands;
use Livewire\Component;

class Brand extends Component
{
    public $brand='';//for link with html text input
    public $allbrands=[];//for link with html table view

    public $editform=false;


    public function render()
    {
        return view('livewire.brands.brand');
    }

    public function mount(){
         $this->allbrands=brands::all();
    }
    public function save(){
        $validated=$this->validate([
            'brand'=>'required|max:255',
        ]);

        brands::create($validated);
        // Flash message
        session()->flash('message', 'Brand created successfully!');
          $this->reset();
        // return redirect()->to('/brand'); // Change this to your actual route
        return $this->redirect('/brand', );

    }
     public function clearform()
     {

         $this->brand = '';

     }


    //  #[On('edit-mode')]
    //  public function edit($id){
    //      $this->editform=true;
    //     //  $this->formtitle='Edit Product';
    //     //  $this->product=Product::findOrFail($id);
    //     //  $this->title=$this->product->title;
    //     //  $this->description=$this->product->description;
    //     //  $this->price=$this->product->price;
    //  }
}
