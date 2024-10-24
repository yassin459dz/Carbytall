<?php

namespace App\Models;

use App\Livewire\Car;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    protected $fillable = [
        'name' ,
        'phone' ,
        'phone2' ,
        'address',
        'remark',
        'sold',
    ];
}
