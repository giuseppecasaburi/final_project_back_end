@extends('layouts.app')

@section('content')
    <div class="container my-4">
        {{-- HEADER --}}
        <div
            class="header-content d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center my-3">
            <h2 class="mb-2 mb-lg-0">{{ $director->name }} {{ $director->surname }}</h2>
        </div>

        {{-- BODY --}}
        <div class="body-content d-flex flex-column flex-lg-row">
            {{-- IMMAGINE --}}
            <div class="image-content w-25 w-lg-100 mb-3 mb-lg-0">
                @if ($director->image != null)
                    <img src="{{ asset('storage/' . $director->image) }}" alt="Foto regista" class="img-fluid rounded">
                @else
                    <div class="d-flex justify-content-center align-items-center h-100">Nessuna immagine collegata</div>
                @endif
            </div>

            {{-- INFO --}}
            <div class="info-content d-flex flex-column w-100 px-lg-3">

                {{-- STORY --}}
                <p class="fs-5">{{ $director->description }}</p>

                {{-- ANNO --}}
                <p class="fs-5">Anno di nascita: {{ \Carbon\Carbon::parse($director->date_of_birth)->format('d/m/Y') }}
                </p>

                {{-- DURATA --}}
                <span class="fs-5">Nazionalità: {{ $director->nationality }}</span>

                {{-- BOTTONI --}}
                <div class="buttons mt-3 mt-lg-auto d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('directors.edit', $director->id) }}"
                        class="btn btn-outline-warning w-50 w-sm-auto">Modifica Regista</a>

                    <button type="button" class="btn btn-outline-danger w-50" data-bs-toggle="modal"
                        data-bs-target="#deleteMovieModal">Elimina Regista</button>

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
                                    Sei sicuro di voler eliminare il regista <strong>{{ $director->name }}
                                        {{ $director->surname }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('directors.destroy', $director->id) }}" method="POST"
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
                                        alt="{{ $related->title }}" style="object-fit: cover; height: 200px;">
                                @else
                                    <div style="height: 200px; color: #ffa500"
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
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary w-sm-auto">Torna alla home</a>
        </div>
    </div>
@endsection