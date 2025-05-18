@extends('layouts.app')
@section('title', $genre->name)

@section('content')
    <div class="container px-3 px-sm-0 my-4">
        {{-- HEADER --}}
        <div
            class="header-content d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center my-3">
            <h2 class="mb-2 mb-lg-0">Genere: {{ $genre->name }}</h2>
        </div>

        {{-- BODY --}}
        <div class="w-100 d-flex flex-column flex-sm-row justify-content-around my-0 my-sm-5">
            <p class="fs-5">Nome genere: {{ $genre->name }}</p>
            <span class="fs-5">Colore HEX: <span id="genre-color"
                    style="background-color: {{ $genre->color }}">{{ $genre->color }}</span></span>
        </div>

        {{-- BOTTONI --}}
        <div class="buttons mt-3 mt-lg-auto d-flex flex-column flex-sm-row gap-2">
            <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-outline-warning w-50 w-sm-auto">Modifica
                Genere</a>

            <button type="button" class="btn btn-outline-danger w-50" data-bs-toggle="modal"
                data-bs-target="#deleteMovieModal">Elimina Genere</button>

            <!-- Modal di conferma -->
            <div class="modal fade" id="deleteMovieModal" tabindex="-1" aria-labelledby="deleteMovieModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"> <!-- centrato verticalmente -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteMovieModalLabel">Conferma Eliminazione</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare il genere <strong>{{ $genre->name }}</strong>? Verrà rimosso
                            anche da tutti i film a cui è collegato.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- FILM COLLEGATI --}}
        <div class="related-movies mt-4">
            <h3 class="mt-5 mb-3">Film collegati</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @if (count($relatedMovies) != 0)
                    @foreach ($relatedMovies as $related)
                        <div class="col">
                            <div class="card h-100 d-flex flex-column shadow-sm">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top"
                                        alt="{{ $related->title }}"
                                        style="object-fit: cover; object-position: top; height: 400px;">
                                @else
                                    <div style="height: 400px; color: #ffa500"
                                        class="justify-content-center d-flex align-items-center">Nessuna immagine collegata
                                    </div>
                                @endif
                                <div class="card-header">
                                    <h4 class="card-title mb-1">{{ $related->title }}</h4>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text flex-grow-1">Anno di pubblicazione:
                                        {{ \Carbon\Carbon::parse($related->year)->format('d/m/Y') }}</p>
                                    <span>Durata: {{ $related->duration }} minuti</span><br>
                                    @if ($related->director)
                                        <p class="card-text flex-grow-1">{{ $related->director['name'] }}
                                            {{ $related->director['surname'] }}</p>
                                    @else
                                        <p class="card-text flex-grow-1">Nessun regista collegato</p>
                                    @endif
                                    @if ($related->genres)
                                        <div class="pb-3">
                                            @forelse ($related->genres as $genre)
                                                <span class="mb-2 rounded-5 p-2 me-1 d-inline-block text-white"
                                                    style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                                            @empty
                                                <p class="card-text flex-grow-1">Nessun genere collegato</p>
                                            @endforelse
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer ">
                                    <a href="{{ route('movies.show', $related->id) }}"
                                        class="btn btn-outline-warning mt-auto w-100">Visualizza
                                        Film</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>Nessun Film Collegato.</div>
                @endif
            </div>
        </div>

        {{-- LINK TORNA ALLA HOME --}}
        <div class="mt-3">
            <a href="{{ route('genre.index') }}" class="btn btn-outline-secondary w-sm-auto">Torna alla home</a>
        </div>
    </div>
@endsection
