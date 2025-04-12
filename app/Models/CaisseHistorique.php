<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaisseHistorique extends Model
{
    protected $fillable = [
        'date', 'type', 'montant', 'description', 'facture_id'
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function facture()
    {
        return $this->belongsTo(Factures::class);
    }
}
