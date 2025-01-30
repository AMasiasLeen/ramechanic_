<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Support\Facades\Auth;

class VehicleModel extends Model implements Recordable
{
    use HasFactory;
    use \Altek\Accountant\Recordable;

    protected $guarded = [];

    protected $with = ["create_uid", "brand"];

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

    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
