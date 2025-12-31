@extends('layouts.main')

@section('content')
    <div class="container container-fluid mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Pokemon Abilities</h1>
                            </div>
                            {{-- <div class="col-md-6">
                                <form action="/abilities/sync" method="POST">
                                    @csrf
                                    <button class="btn btn-success float-end">Sync Data From API</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pokemon Id</th>
                                    <th scope="col">Abilities Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pokemonAbilities as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->pokemon_id }}</td>
                                        <td>{{ $data->abilities_id }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
