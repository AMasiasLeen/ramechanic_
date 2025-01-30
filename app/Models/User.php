<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Altek\Accountant\Contracts\Identifiable;

class User extends Authenticatable implements Identifiable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = ["rol", "password"];

    protected $with = ["create_uid", "vehicle"];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getIdentifier()
    {
        return $this->getKey();
    }

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
        return $this->hasMany(Vehicle::class);
    }
}
