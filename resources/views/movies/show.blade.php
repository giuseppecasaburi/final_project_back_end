@extends('layouts.app')

@section('content')
    <div class="container my-4">
        {{-- HEADER --}}
        <div
            class="header-content d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center my-3">
            <h2 class="mb-2 mb-lg-0">{{ $movie->title }}</h2>
            <p class="mb-0 fs-5">Voto: {{ $movie->vote }}/10</p>
        </div>

        {{-- BODY --}}
        <div class="body-content d-flex flex-column flex-lg-row">
            {{-- IMMAGINE --}}
            <div class="image-content w-25 w-lg-100 mb-3 mb-lg-0">
                @if ($movie->image)
                    <img src="{{ asset('storage/' . $movie->image) }}" alt="locandina del film" class="img-fluid rounded">
                @else
                    <div class="d-flex justify-content-center align-items-center h-100">Nessuna immagine collegata</div>
                @endif
            </div>

            {{-- INFO --}}
            <div class="info-content d-flex flex-column w-100 px-lg-3 py-2">
                {{-- GENERI --}}
                <div class="mb-3">
                    @forelse ($movie->genres as $genre)
                        <span class="rounded-5 p-2 me-1 d-inline-block text-white"
                            style="background-color: {{ $genre->color }}">
                            {{ $genre->name }}
                        </span>
                    @empty
                    @endforelse
                </div>

                {{-- REGISTA --}}
                <h5 class="mb-3">Regista: {{ $movie->director->name }} {{ $movie->director->surname }}</h5>

                {{-- STORY --}}
                <p class="fs-5">{{ $movie->story }}</p>

                {{-- ANNO --}}
                <p class="fs-5">Anno di pubblicazione:
                    {{ \Carbon\Carbon::parse($movie->year_of_publication)->format('d/m/Y') }}</p>

                {{-- DURATA --}}
                <span class="fs-5">Durata: {{ $movie->duration }} minuti</span>

                {{-- BOTTONI --}}
                <div class="buttons mt-3 mt-lg-auto d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('movies.edit', $movie->id) }}"
                        class="btn btn-outline-warning w-50 w-sm-auto">Modifica Movie</a>

                    <button type="submit" class="btn btn-outline-danger w-50" data-bs-toggle="modal"
                            data-bs-target="#deleteMovieModal">Elimina Movie</button>

                    <!-- Modal di conferma -->
                    <div class="modal fade" id="deleteMovieModal" tabindex="-1" aria-labelledby="deleteMovieModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered"> <!-- centrato verticalmente -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMovieModalLabel">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Chiudi"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare il film <strong>{{ $movie->title }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- RECENSIONE --}}
        <div class="body-review mt-4">
            <div class="d-flex justify-content-between align-items-lg-center flex-column flex-lg-row">
                <h5>Recensione</h5>
                <p class="mb-0">Voto: {{ $movie->vote }}/10</p>
            </div>
            @if ($movie->review)
                <p>{{ $movie->review }}</p>
            @else
                <p>Nessuna recensione presente.</p>
            @endif
        </div>

        {{-- LINK TORNA ALLA HOME --}}
        <div class="mt-3">
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary w-sm-auto">Torna alla home</a>
        </div>
    </div>
@endsection