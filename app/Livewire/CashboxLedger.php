<?php

namespace App\Livewire;

use App\Models\Factures;
use App\Models\CaisseHistorique;
use App\Models\Cashbox;
use Livewire\Component;
use Illuminate\Support\Carbon;

class CashboxLedger extends Component
{
    public $searchDateFrom;
    public $searchDateTo;
    public array $dailyBalances = [];
    public ?string $selectedDate = null;
    public $facturesOfDay = [];
    public $mouvementsOfDay = [];
    public ?string $endEditDate = null;
    public ?float $endValue = null;
    public bool $showEndModal = false;

    public function mount()
    {
        $today = now()->startOfDay();

        // Check if a cashbox already exists today
        $existing = Cashbox::whereDate('created_at', $today)->exists();

        if (! $existing) {
            $yesterdayBox = Cashbox::orderByDesc('created_at')->first();
            Cashbox::create([
                'start_value' => $yesterdayBox?->end_value ?? 0,
            ]);
        }

        $this->loadBalances();
    }

    public function loadBalances()
    {
        $this->dailyBalances = Cashbox::orderByDesc('created_at')
        ->get()
        ->mapWithKeys(function (Cashbox $box) {
            $date = $box->created_at->toDateString();

            $inflow = Factures::whereDate('created_at', $date)->sum('total_amount');
            $outflow = CaisseHistorique::whereDate('created_at', $date)
                        ->where('type', 'SORTIE')
                        ->sum('montant');

            $solde = $box->start_value + $inflow - $outflow;

            return [
                $date => [
                    'start'  => $box->start_value,
                    'entree' => $inflow,
                    'sortie' => $outflow,
                    'solde'  => $solde,
                ],
            ];
        })
        ->toArray();
    }

    public function view(string $date)
    {
        $this->selectedDate    = $date;
        $this->facturesOfDay   = Factures::whereDate('created_at', $date)->with(['client', 'car'])->get();
        $this->mouvementsOfDay = CaisseHistorique::whereDate('created_at', $date)->get();
    }

    public function editEndValue(string $date)
    {
        $this->endEditDate = $date;

        $cashbox = Cashbox::whereDate('created_at', $date)->first();

        $this->endValue = $cashbox?->end_value ?? $this->dailyBalances[$date]['solde'];
        $this->showEndModal = true;
    }

    public function saveEndValue()
    {
        if ($this->endEditDate && $this->endValue !== null) {
            Cashbox::whereDate('created_at', $this->endEditDate)
                ->update(['end_value' => $this->endValue]);

            $this->loadBalances();
        }

        $this->showEndModal = false;
        session()->flash('message', 'End value updated.');
    }

    public function render()
    {
        return view('livewire.Cashbox.caisse', [
            'dailyBalances'   => $this->dailyBalances,
            'facturesOfDay'   => $this->facturesOfDay,
            'mouvementsOfDay' => $this->mouvementsOfDay,
        ]);
    }
}
