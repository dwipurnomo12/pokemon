<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $guarded = ['id'];

    public function abilities()
    {
        return $this->belongsToMany(Abilities::class, 'pokemon_abilities', 'pokemon_id', 'abilities_id');
    }
}
