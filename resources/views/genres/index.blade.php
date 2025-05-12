@extends('layouts.app')
@section('content')
    <div class="container my-3">
        <h2 class="mb-4 d-flex flex-column flex-sm-row align-items-center">Catalogo Generi <a href="{{route('genre.create')}}" class="btn btn-outline-warning ms-0 mt-3 mt-sm-0 ms-sm-3">Aggiungi un Genere</a></h2>
        
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($genres as $genre)
                <div class="col">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-header">
                            <h4 class="card-title">{{ $genre->name }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p>Codice HEX: <span class="rounded-5 p-1" style="background: {{$genre->color}}">{{ $genre->color }}</span></p>
                            <a href="{{ route('genre.edit', $genre->id)}}" class="btn btn-outline-warning w-50 mt-2">Modifica</a>
                            <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger w-50 mt-2" type="submit">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">{{ $genres->links() }}</div>
    </div>
@endsection
