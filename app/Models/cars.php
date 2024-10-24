<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{
    protected $fillable = [
        'brand_id' ,
        'model' ,
    ];
      public function cars() {
          return $this->hasMany(Cars::class);
      }

    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }
}
