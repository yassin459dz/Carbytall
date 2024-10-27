<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{
    protected $fillable = [
        'brand_id' ,
        'model' ,
    ];
    public function brand()
    {
        return $this->belongsTo(brands::class); // Singular "brand" for the method name
    }
}
