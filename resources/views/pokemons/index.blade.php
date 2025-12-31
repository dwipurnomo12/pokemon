@extends('layouts.main')

@section('content')
    <div class="container container-fluid mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Pokemons</h1>
                            </div>
                            <div class="col-md-6">
                                <form action="/pokemon/sync" method="POST">
                                    @csrf
                                    <button class="btn btn-success float-end">Sync Data From API</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            Proses sync data mengambil data pokemon per-20 data
                        </div>

                        <form action="/filter-data-pokemon" method="GET">
                            <select name="filter-pokemon" id="filter-pokemon">
                                <option value="light">light</option>
                                <option value="Medium">medium</option>
                                <option value="Heavy">Heavy</option>
                                <option value="All">All</option>
                            </select>
                        </form>

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Base Experiences</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Image Path</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pokemons as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->base_experience ?? '-' }}</td>
                                            <td>{{ $data->weight ?? '-' }}</td>
                                            <td>{{ $data->image_path ?? '-' }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
