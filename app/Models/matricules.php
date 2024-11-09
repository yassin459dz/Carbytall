<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class matricules extends Model
{
    protected $fillable = [
        'client_id', // Ensure this is present if you want to link to Client
        'car_id',
        'mat',
        'km',
        'color',
        'anne',
        'work',
        'remark',

    ];


    // Method called before saving the model
    // public static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($model) {
    //         // Ensure that `matricule_id` is set when saving
    //         if (is_null($model->id) && $model->mat) {
    //             // Logic to handle new matricule creation
    //             // For instance, assign a new ID or perform other actions
    //         }
    //     });

    // }

    public function client()
    {
        return $this->belongsTo(clients::class); // If you need this association
    }
    //  public function bl() {
    //      return $this->hasMany(BL::class);
    //  }

     public function car()
     {
         return $this->belongsTo(cars::class);
     }

}
