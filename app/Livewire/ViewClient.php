<?php

namespace App\Livewire;

use Livewire\Component;

class ViewClient extends Component
{
    public $isVisible = false;

    public function render()
    {
        return view('livewire.clients.view-client');
    }

    // public function toggleModal()
    // {
    //     $this->isVisible = !$this->isVisible;
    // }

    public function toggleModal()
{
    $this->isVisible = !$this->isVisible;
    if ($this->isVisible) {
        $this->dispatch('modal-open');
    } else {
        $this->dispatch('modal-close');
    }
}

}
