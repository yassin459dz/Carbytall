<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\cars;
use App\Models\brands;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;


class CreateCar extends Component
{

    public $allbrands;
    public $formtitle = 'Create Car';
    public $editform = false;
    public $carss;

    #[Rule('required')]
    public $brand_id;  // Added property

    #[Rule('required')]
    public $model;

    public function mount()
    {
        // $this->allbrands = cars::all();
        // $this->allbrands = cars::with('brand')->get(); // Use "brand" instead of "brands"
        $this->allbrands = brands::all(); // Retrieve all brands

    }

    public function render()
    {
        return view('livewire.cars.create-car');
    }

    public function save()
    {
        $validated = $this->validate();
        // Cars::create($validated);  // brand_id will now be included in the save
        // $this->dispatch('refresh-cars');
        // $this->close();
        // $this->dispatch('browser', 'close-modal');
        // return $this->redirect('/car', navigate: true);

            // Validate the input data
    // $validated = $this->validate([
    //     'brand_id' => 'required|exists:brands,id',
    //     'model' => 'required|string|max:255',
    // ]);

    // Create a new car with the validated data
    $validated = $this->validate();
    Cars::create($validated);

    // Clear form fields and dispatch events
    session()->flash('status-updated', 'Car created successfully!');
    $this->dispatch('refresh-cars');
    $this->close(); // Reset fields

    // Redirect or close modal if needed
    $this->dispatch('browser', 'close-modal');
    return $this->redirect('/car', navigate: true);
    }

    #[On('reset-modal')]
    public function close()
    {
        $this->reset();
    }

    #[On('edit-mode')]
    public function edit($id)
    {
        $this->editform = true;
        $this->formtitle = 'Edit Client';
        $this->carss = Cars::findOrFail($id);
        $this->brand_id = $this->carss->brand_id;  // Set brand_id for edit
        $this->model = $this->carss->model;
    }

    public function update()
    {
        $validated = $this->validate();
        $p = Cars::findOrFail($this->carss->id);
        $p->update($validated);
        $this->dispatch('refresh-cars');
        session()->flash('status-updated', 'Car Updated');
        $this->dispatch('browser', 'close-modal');
    }
}
