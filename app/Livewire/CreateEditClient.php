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
    #[Rule('required')]
    public $phone;
    #[Rule('nullable')]

    public $phone2;
    public $address;
    public $remark;
    public $sold;





    public function render()
    {
        return view('livewire.clients.create-edit-client');
    }

    public function save (){
        $validated=$this->validate();
        clients::create($validated);
        $this->dispatch('refresh-clients');
        // session()->flash('status', 'Client Created');
        // session()->flash('status-created', 'Client Created');
        $this->close();// ADD THIS TO REFRESH PAGE WITH PHP
        $this->dispatch('browser', 'close-modal');
        return $this->redirect('/client', navigate:true);


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
        $this->phone=$this->client->phone;
        $this->phone2=$this->client->phone2;
        $this->address=$this->client->address;
        $this->remark=$this->client->remark;
        $this->sold=$this->client->sold;

    }

    public function update(){
        $validated=$this->validate();
        $p=clients::findOrFail($this->client->id);
        $p->update($validated);
        $this->dispatch('refresh-clients');
        session()->flash('status-updated', value: 'Client Updated');
        $this->dispatch('browser', 'close-modal');

    }

    public function refreshPage()
    {
        // Any logic you want to run before refresh (optional)

        // Redirect to the same route to refresh the page
        return $this->redirect('/client', navigate:true);

    }



}
