<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\clients;
use Livewire\Attributes\On;

class Client extends Component
{

    public $clients;
    public function mount(){

        $this->clients = clients::all();

    }
    public function render()
    {
        return view('livewire.clients.client');
    }


    public function delete(clients $clients){
        $clients->delete();
        session()->flash('status-delete', 'Client Deleted'); // Change this to 'delete' for alert color differentiation
        return $this->redirect('/client', navigate:true);

    }

    #[On('refresh-clients')]
    public function refreshClient(){
        $this->clients=clients::all();
    }
}
