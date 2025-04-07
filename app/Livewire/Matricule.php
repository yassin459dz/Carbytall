<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\matricules;

class Matricule extends Component
{
    use WithPagination;

<<<<<<< HEAD
    // Add this to specify which pagination theme to use
    protected $paginationTheme = 'tailwind';

    public $search = '';

    public function render()
    {
        // Fetch matricules with pagination and search filter
        // Fetch matricules with pagination and search filter
        $matricules = Matricules::withCount('factures')
            ->when($this->search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    // Search in matricules table (mat field)
                    $q->where('mat', 'like', '%' . $search . '%')
                    // Search in client table (name and phone fields)
                    ->orWhereHas('client', function($subq) use ($search) {
                        $subq->where('name', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
                });
            })
            ->paginate(10);

        return view('livewire.matricule.matricule', compact('matricules'));
=======
    // Removed the public $matricules property from mount()

    public function mount()
    {
        // No need to load matricules here since we're paginating in render()
    }

    public function render()
    {
        // Fetch matricules with pagination (10 per page)
    // Eager load the count of 'factures' for each matricule
    $matricules = matricules::withCount('factures')->paginate(10);

    return view('livewire.matricule.matricule', compact('matricules'));

>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
    }

    #[On('refresh-matricules')]
    public function refreshCar()
    {
        $this->resetPage(); // Reset pagination when refreshed
    }
<<<<<<< HEAD

    public function updatingSearch()
    {
        $this->resetPage();
    }
=======
    public function updatingSearch()
{
    $this->resetPage();
}

>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
}
