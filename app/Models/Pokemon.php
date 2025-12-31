<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $guarded = ['id'];

    public function pokemon_abilities()
    {
        return $this->hasMany('pokemon_abilities');
    }
}
