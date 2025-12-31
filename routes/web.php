<?php

use App\Http\Controllers\AbilitiesController;
use App\Http\Controllers\PokemonAbilitiesController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon-filter-data', [PokemonController::class, 'filterData']);
Route::get('/pokemons', [PokemonController::class, 'index']);
Route::post('/pokemon/sync', [PokemonController::class, 'syncPokemonData']);

Route::get('/abilities', [AbilitiesController::class, 'index']);
Route::post('/abilities/sync', [AbilitiesController::class, 'syncAbilitiesData']);

Route::get('/pokemon-abilities', [PokemonAbilitiesController::class, 'index']);
