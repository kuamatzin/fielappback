<?php

namespace App;

use App\Business;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('business', function(Builder $builder){
            $builder->with('business');
        });

        static::addGlobalScope('cards', function(Builder $builder){
            $builder->with('cards');
        });
    }

    public function business()
    {
        return $this->hasMany(Business::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class)->withPivot('uses', 'completed');;
    }
}
