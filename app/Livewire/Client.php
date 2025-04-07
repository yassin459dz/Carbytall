<?php
<<<<<<< HEAD
namespace App\Livewire;

use Livewire\Component;
use App\Models\clients; // Renamed from clients to Client
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Client extends Component
{
    public $client;
    public $name;
    public $phone;
    public $search = '';
    use WithPagination;


    public function render()
    {
        $query = clients::query();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        $clients = $query->paginate(50);

        return view('livewire.clients.client', compact('clients'));
    }

    #[On('refresh-clients')]
    public function refreshCar()
    {
        $this->resetPage(); // Reset pagination when refreshed
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
=======

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

        return view('livewire.clients.client');
        //    if(! $this->search){
        //        $this->clients=clients::all();
        //    }else{
        //        $this->clients=clients::where('name','like','%' .$this->search.'%')->get();
        //    }
        // return view('livewire.clients.client');
    }

    public function search()
    {
        return "test";
    }
    // this for send data to edit page

        public function mount(){

        $this->clients = clients::all();
        }



    #[On('refresh-clients')]
    public function refreshClient(){
         $this->clients=clients::all();
        // $this->resetPage();
    }

>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
}
