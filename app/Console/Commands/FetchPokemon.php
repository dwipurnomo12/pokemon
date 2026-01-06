<?php

namespace App\Console\Commands;

use App\Models\Abilities;
use App\Models\Pokemon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        for ($id = 1; $id <= 400; $id++) {

            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");

            if (! $response->successful()) {
                continue;
            }

            $data = $response->json();

            // FILTER WEIGHT
            if ($data['weight'] < 100) {
                continue;
            }

            // DOWNLOAD IMAGE
            $imageUrl = $data['sprites']['front_default'];
            if (! $imageUrl) {
                continue;
            }

            $imageContent = Http::get($imageUrl)->body();
            $imagePath = "pokemons/{$id}.png";
            Storage::disk('public')->put($imagePath, $imageContent);

            // INSERT POKEMON
            $pokemon = Pokemon::create([
                'name' => $data['name'],
                'base_experience' => $data['base_experience'],
                'weight' => $data['weight'],
                'image_path' => "storage/{$imagePath}",
            ]);

            // ABILITIES
            foreach ($data['abilities'] as $abilityData) {

                if ($abilityData['is_hidden'] === true) {
                    continue;
                }

                $ability = Abilities::firstOrCreate([
                    'name' => $abilityData['ability']['name']
                ]);

                $pokemon->abilities()->attach($ability->id);
            }
        }

        $this->info('Fetch Pokémon selesai');
    }
}
