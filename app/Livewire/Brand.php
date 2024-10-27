<?php

namespace App\Livewire;
use App\Models\brands;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Brand extends Component
{
    public $brands;
    public $brand;
    public $image;
    public $search='';

    use WithPagination;


    public function render()
    {
        return view('livewire.brands.brand');
    }


    public function mount(){

    $this->brands = brands::all();
    }



    #[On('refresh-brands')]
    public function refreshClient(){
     $this->brands=brands::all();
    // $this->resetPage();
    }



}
