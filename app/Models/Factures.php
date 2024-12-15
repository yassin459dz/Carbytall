<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    protected $fillable = [
        'client_id',
        'car_id',
        'matricule_id',
        'km',
        'mat',
        'bl_number',
        'price',
        'qte',
        'total',
        'remark',
        'total_amount',
        'extra_charge',
        'discount_amount',
        'order_items',

    ];

    public function client()
    {
        return $this->hasMany(clients::class);
    }

    public function car()
    {
        return $this->hasMany(cars::class);
    }

    public function matricule()
    {
        return $this->hasMany(matricules::class); // Changed from hasMany to belongsTo
    }
}
