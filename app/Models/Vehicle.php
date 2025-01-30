<?php

namespace App\Models;

use Altek\Accountant\Contracts\Recordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model implements Recordable
{
    use HasFactory;
    use \Altek\Accountant\Recordable;


    protected $guarded = [];

    protected $with = ["create_uid", "vehicle_model"];

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

    function vehicle_model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    function owner()
    {
        return $this->belongsTo(User::class);
    }

    function records() {
        return $this->hasMany(Record::class);
    }
}
