@extends('layouts.app')

@section('content')
    <div class="sidebar">
        <form action="{{ route('search') }}" method="GET">
            <h4>Filtra per Genere</h4>
            @foreach ($genres as $genre)
                <label>
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                        {{ in_array($genre->id, request()->get('genres', [])) ? 'checked' : '' }}>
                    {{ $genre->name }}
                </label>
            @endforeach

            <h4 class="mt-4">Filtra per Regista</h4>
            @foreach ($directors as $director)
                <label>
                    <input type="checkbox" name="directors[]" value="{{ $director->id }}"
                        {{ in_array($director->id, request()->get('directors', [])) ? 'checked' : '' }}>
                    {{ $director->name }}
                </label>
            @endforeach

            <button type="submit" class="btn btn-warning mt-4 w-100">Applica Filtri</button>
        </form>
    </div>



    <div class="content">
        @if ($movies->count() || $directors->count())
            @if ($movies->count())
                @foreach ($movies as $movie)
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="col">
                            <div class="card h-100">
                                @if ($movie->image)
                                    <img src="{{ asset('storage/' . $movie->image) }}" class="card-img-top"
                                        alt="{{ $movie->title }}" style="object-fit: cover; height: 200px;">
                                @endif
                                <div class="card-header">
                                    <h4 class="card-title">{{ $movie->title }}</h4>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text flex-grow-1">{{ $movie->year_of_publication }}</p>
                                    <p class="card-text flex-grow-1">{{ $movie->director }}</p>
                                    <a href="{{ route('movies.show', $movie->id) }}"
                                        class="btn btn-outline-warning mt-2">Visualizza
                                        Film</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($directors->count())
                @foreach ($directors as $director)
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="col">
                            <div class="card h-100">
                                @if ($director->image)
                                    <img src="{{ asset('storage/' . $director->image) }}" class="card-img-top"
                                        alt="{{ $director->title }}" style="object-fit: cover; height: 200px;">
                                @endif
                                <div class="card-header fs-3">
                                    <h4 class="card-title">{{ $director->name }} {{ $director->surname }}</h4>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <a href="{{ route('directors.show', $director->id) }}"
                                        class="btn btn-outline-warning mt-2">Visualizza Regista</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @else
            <p class="animated-modal">Nessuna corrispondenza trovata</p>
        @endif
    @endsection
</div>
