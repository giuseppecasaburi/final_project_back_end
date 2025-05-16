@extends('layouts.app')
@section('title', 'Catalogo Films')
@section('content')
<div class="container my-3">
        <h2 class="mb-4 d-flex flex-column flex-sm-row align-items-center">Catalogo Films <a href="{{route('movies.create')}}" class="btn btn-outline-warning ms-0 mt-3 mt-sm-0 ms-sm-3">Aggiungi un Film</a></h2>
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($movies as $movie)
                <div class="col">
                    <div class="card h-100 d-flex flex-column">
                        @if ($movie->image)
                            <img src="{{ asset('storage/' . $movie->image) }}" class="card-img-top" alt="{{ $movie->title }}"
                                style="object-fit: cover; object-position: top; height: 400px;">
                        @else
                            <div style="height: 400px; color: #ffa500" class="justify-content-center d-flex align-items-center">Nessuna immagine collegata</div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">{{ $movie->title }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="card-text flex-grow-1">{{ $movie->year_of_publication }}</p>
                            <span>Durata: {{ $movie->duration }} minuti</span><br>
                            @if ($movie->director)
                                <p class="card-text flex-grow-1">{{ $movie->director['name'] }}
                                    {{ $movie->director['surname'] }}</p>
                            @else
                                <p class="card-text flex-grow-1">Nessun regista collegato</p>
                            @endif
                            @if ($movie->genres)
                                            <div class="pb-3">
                                                @forelse ($movie->genres as $genre)
                                                    <span class="mb-2 rounded-5 p-2 me-1 d-inline-block text-white"
                                                        style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                                                @empty
                                                    <p class="card-text flex-grow-1">Nessun genere collegato</p>
                                                @endforelse
                                            </div>
                                        @endif
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-warning mt-auto">Visualizza
                                Film</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">{{$movies->links()}}</div>
    </div>
@endsection