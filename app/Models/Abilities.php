<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    protected $guarded = ['id'];

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
