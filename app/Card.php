<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('business', function(Builder $builder){
            $builder->with('business');
        });
    }
    
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
