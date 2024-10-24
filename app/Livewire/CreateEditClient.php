<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;
use App\Models\clients;

class CreateEditClient extends Component
{
    public $client;
    public $formtitle='Create Client';
    public $editform=false;
    #[Rule('required')]
    public $name;



    public function render()
    {
        return view('livewire.clients.create-edit-client');
    }

    public function save (){
        $validated=$this->validate();
        clients::create($validated);
        $this->dispatch('refresh-clients');
        session()->flash('status', 'Client Created');

        // session()->flash('status-created', 'Client Created');

        $this->close();// ADD THIS TO REFRESH PAGE WITH PHP

        // return $this->redirect('/client', navigate:true);

    }

    #[On('reset-modal')]
    public function close(){
        $this->reset();
    }

    #[On('edit-mode')]
    public function edit($id){
        // dd($id);
        $this->editform=true;
        $this->formtitle='Edit Client';
        $this->client=clients::findOrFail($id);
        $this->name=$this->client->name;
    }

    public function update(){
        $validated=$this->validate();
        $p=clients::findOrFail($this->client->id);
        $p->update($validated);
        $this->dispatch('refresh-clients');

        // session()->flash('status-updated', value: 'Client Updated');
        session()->flash('status', value: 'Client Updated');

        $this->close();
        // return $this->redirect('/client', navigate:true);

    }

}
