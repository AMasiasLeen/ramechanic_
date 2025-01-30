<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Brand extends Model implements Recordable
{
    use HasFactory;
    use \Altek\Accountant\Recordable;

    protected $guarded = [];

    protected $with = ["create_uid"];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }

    function create_uid()
    {
        return $this->belongsTo(User::class);
    }

    function vehicles(){
        return $this->hasManyThrough(Vehicle::class, VehicleModel::class);
    }
}
