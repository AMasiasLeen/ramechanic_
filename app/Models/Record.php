<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Record extends Model implements Recordable
{
    use HasFactory;
    use \Altek\Accountant\Recordable;

    protected $guarded = ["owner_id"];

    protected $with = ["create_uid","vehicle"];

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

    
    function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    function owner()
    {
        return $this->belongsTo(User::class);
    }

    function richal(){

        
    }
}