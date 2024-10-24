<?php

namespace App\Models;
use App\Models\cars;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $fillable = [
        'brand' ,
        'image' ,
    ];
      public function cars() {
          return $this->hasMany(Cars::class);
      }

    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }
}
