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


    #[On('refresh-clients')]
    public function refreshClient(){
        $this->clients=clients::all();
    }
}
