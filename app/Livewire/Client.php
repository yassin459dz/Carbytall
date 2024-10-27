<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\clients;
use Livewire\Attributes\On;
use Livewire\WithPagination;
class Client extends Component
{

    public $clients;
    public $client;

    public $name;
    public $phone;

    public $search='';

    use WithPagination;

    public function render()
    {
        $this->clients=clients::all();

        return view('livewire.clients.client', [
            'clients'=> clients::latest()->where('name', 'phone', "%{$this->search}%")
        ]);
           if(! $this->search){
               $this->clients=clients::all();
           }else{
               $this->clients=clients::where('name','like','%' .$this->search.'%')->get();
           }
        // return view('livewire.clients.client');
    }

    public function search()
    {
        return "test";
    }

    //    public function mount(){

    //    $this->clients = clients::all();
    //    }



    #[On('refresh-clients')]
    public function refreshClient(){
         $this->clients=clients::all();
        // $this->resetPage();
    }

}
