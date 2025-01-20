<?php

namespace App\Models;

use App\Models\cars;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
