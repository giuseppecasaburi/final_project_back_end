@extends('layouts.app')

{{-- Sezione main di app --}}
@section('content')
    <div class="container">
        <h2 class="fs-3 text-secondary my-4">
            Bacheca
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-secondary fs-4">Bacheca utente</div>
                    <div class="card-body">
                        <div>
                            <p class="fs-4">Gestisci le tue enità</p>
                            <div class="d-flex justify-content-center text-center">
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/films.webp" class="card-img" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Films</h4>
                                        <p class="card-text">Ogni film è un'opera unica che racconta una storia attraverso immagini, suoni ed emozioni. Può appartenere a diversi generi e avere uno o più registi. Ogni titolo è accompagnato da una descrizione, una locandina e dati specifici come l’anno di uscita e la durata.</p>
                                        <a href="{{route("movies.index")}}" class="btn btn-outline-warning">Visualizza tutti i Films</a>
                                    </div>
                                </div>
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/tarantino.jpg" class="card-img h-100" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Registi</h4>
                                        <p class="card-text">I registi sono le menti creative dietro la macchina da presa. Supervisionano ogni aspetto della produzione di un film, dalla sceneggiatura alla direzione degli attori, trasformando idee in esperienze visive. Ogni regista può avere diretto uno o più film.</p>
                                        <a href="{{route("directors.index")}}" class="btn btn-outline-warning">Visualizza tutti i Registi</a>
                                    </div>
                                </div>
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/generi.jpg" class="card-img h-100" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Generi</h4>
                                        <p class="card-text">I generi classificano i film in base a temi e stili narrativi. Thriller, commedia, drammatico, fantascienza: ogni genere aiuta lo spettatore a scegliere l’atmosfera e il tipo di emozione che vuole vivere. Un film può appartenere a più generi.</p>
                                        <a href="{{route("genre.index")}}" class="btn btn-outline-warning">Visualizza tutti i Generi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="fs-4">Aggiungi una nuova entità</p>
                            <div class="d-flex justify-content-center text-center">
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/film.jpg" class="card-img" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Film</h4>
                                        <p class="card-text">Aggiungi un nuovo film, con titolo, regista, genere e immagine.</p>
                                        <a href="{{route("movies.index")}}" class="btn btn-outline-warning">Aggiungi un nuovo Film</a>
                                    </div>
                                </div>
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/nolan.png" class="card-img h-100" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Regista</h4>
                                        <p class="card-text">Aggiungi un nuovo regista da associare ai tuoi film.</p>
                                        <a href="{{route("directors.index")}}" class="btn btn-outline-warning">Aggiungi un nuovo Regista</a>
                                    </div>
                                </div>
                                <div class="card mx-4" style="width: 18rem;">
                                    <img src="storage/site_image/genere.jpg" class="card-img h-100" alt="...">
                                    <div class="card-body card-img-overlay bg-black bg-opacity-75 text-white align-content-center">
                                        <h4 class="card-title">Genere</h4>
                                        <p class="card-text">Crea un nuovo genere per classificare meglio i film presenti.</p>
                                        <a href="{{route("genre.index")}}" class="btn btn-outline-warning">Aggiungi un nuovo Genere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
