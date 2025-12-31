<?php

namespace App\Http\Controllers;

use App\Models\Abilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AbilitiesController extends Controller
{
    public function index()
    {
        $abilities = Abilities::all();
        return view('abilities.index', [
            'abilities' => $abilities
        ]);
    }

    public function syncAbilitiesData()
    {
        $url = 'https://pokeapi.co/api/v2/ability';
        $response = Http::get($url);
        if ($response->successful()) {
            $dataApi = $response->json();

            if (!empty($dataApi) && is_array($dataApi)) {
                foreach ($dataApi['results'] as $item) {
                    Abilities::create([
                        'name' => $item['name'],
                    ]);
                }
                return redirect('/abilities')->with('success', 'Sync Data from API successfully!');
            }
        }
    }
}
