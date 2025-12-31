<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Get Data API Pokemon

    $url = 'https://pokeapi.co/api/v2/pokemon';
    $response = Http::get($url);

    Ini endpoint untuk mengambil semua data pokemon per-20.

## Store Data API Pokemon

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

    method save ke database pokemon, tapi yang tersimpan hanya name saja. Untuk field lain belum bisa.

## Show data pokemon beserta filter

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

    Filter juga tidak berfungsi karena field weight tidak ter insert ke db
