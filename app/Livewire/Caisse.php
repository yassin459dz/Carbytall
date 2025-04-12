<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CaisseHistorique;
use App\Models\Factures;
class Caisse extends Component
{
    use WithPagination;
    public $searchDateFrom;
    public $searchDateTo;

    public function updatingSearchDateFrom()
    {
        $this->resetPage();
    }
    public function updatingSearchDateTo()
    {
        $this->resetPage();
    }
    public function render()
    {
        // Group factures by date and sum total_amount
        $entrees = Factures::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_entree')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        // Group sorties by date and sum montant
        $sorties = CaisseHistorique::where('type', 'SORTIE')
        ->selectRaw('DATE(created_at) as date, SUM(montant) as total_sortie')
        ->groupByRaw('DATE(created_at)')
        ->get()
        ->mapWithKeys(function ($item) {
            return [\Carbon\Carbon::parse($item->date)->toDateString() => $item];
        });

        // Combine both into one list of dates
        $dates = $entrees->keys()->merge($sorties->keys())->unique()->sort();


        return view('livewire.Cashbox.caisse', compact('dates', 'entrees', 'sorties'));
    }
}
