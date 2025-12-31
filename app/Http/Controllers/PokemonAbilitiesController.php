<?php

namespace App\Http\Controllers;

use App\Models\Pokemon_abilities;
use Illuminate\Http\Request;

class PokemonAbilitiesController extends Controller
{
    public function index()
    {
        $pokemonAbilities = Pokemon_abilities::all();
        return view('pokemon-abilities.index', [
            'pokemonAbilities' => $pokemonAbilities
        ]);
    }
}
