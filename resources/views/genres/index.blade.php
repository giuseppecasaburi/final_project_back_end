@extends('layouts.app')
@section('title', 'Catalogo Generi')

@section('content')
    <div class="container my-3">
        <h2 class="mb-4 d-flex flex-column flex-sm-row align-items-center">Catalogo Generi <a
                href="{{ route('genre.create') }}" class="btn btn-outline-warning ms-0 mt-3 mt-sm-0 ms-sm-3">Aggiungi un
                Genere</a></h2>

        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($genres as $genre)
                <div class="col">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-header">
                            <h4 class="card-title">{{ $genre->name }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p>Codice HEX: <span class="rounded-5 p-1"
                                    style="background: {{ $genre->color }}">{{ $genre->color }}</span>
                            </p>
                            <a href="{{ route('genre.show', $genre->id) }}"
                                class="btn btn-outline-warning w-50 mt-2">Visualizza</a>

                            <button class="btn btn-outline-danger w-50 mt-2" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteMovieModal-{{ $genre->id }}">Elimina</button>
                            <!-- Modal di conferma -->
                            <div class="modal fade" id="deleteMovieModal-{{ $genre->id }}" tabindex="-1"
                                aria-labelledby="deleteMovieModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered"> <!-- centrato verticalmente -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMovieModalLabel">Conferma Eliminazione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Chiudi"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di voler eliminare il genere <strong>{{ $genre->name }}</strong>?
                                            Verrà rimosso anche da tutti i film a cui è collegato.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('genre.destroy', $genre->id) }}" method="POST"
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
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">{{ $genres->links() }}</div>
    </div>
@endsection
