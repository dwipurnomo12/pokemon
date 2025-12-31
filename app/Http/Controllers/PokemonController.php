<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{

    public function index(Request $request)
    {
        $query = Pokemon::query();

        if ($request->filled('light')) {
            $query->where('weight', '<', '200');
        }
        if ($request->filled('light')) {
            $query->whereBetween('weight', [201, 300]);
        }
        if ($request->filled('light')) {
            $query->where('weight', '>', '300');
        }
        if ($request->filled('all')) {
            $query->get();
        }

        $pokemons = $query->get();
        return view('pokemons.index', [
            'pokemons' => $pokemons,
        ]);
    }

    public function syncPokemonData()
    {
        $url = 'https://pokeapi.co/api/v2/pokemon';
        $response = Http::get($url);
        if ($response->successful()) {
            $dataApi = $response->json();

            if (!empty($dataApi) && is_array($dataApi)) {
                foreach ($dataApi['results'] as $item) {
                    Pokemon::create([
                        'name' => $item['name'],
                        'base_experience' => $item['base_experience'] ?? '',
                        'weight' => $item['weight'] ?? '',
                        'image_path' => $item['image_path'] ?? '',
                    ]);
                }
                return redirect('/pokemons')->with('success', 'Sync Data from API successfully!');
            }
        }
    }
}
