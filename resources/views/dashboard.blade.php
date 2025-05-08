@extends('layouts.app')

@section('title', 'BackOffice Home')

{{-- Sezione main di app --}}
@section('content')
    <div class="container">
        <h2 class="fs-2 my-4 text-center">
            Bacheca Amministratore
        </h2>

        <!-- Gestisci le tue entità -->
        <div class="card mb-5">
            <div class="card-header fs-3">Gestisci le tue entità</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    @foreach ($contents_cards_show as $content)
                        <div class="col">
                            <div class="card h-100">
                                <img src="storage/site_image/{{ $content['img'] }}" class="card-img-top"
                                    alt="{{ $content['title'] }}" style="object-fit: cover; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">{{ $content['title'] }}</h4>
                                    <p class="card-text flex-grow-1">{{ $content['text'] }}</p>
                                    <a href="{{ route($content['route']) }}" class="btn btn-outline-warning mt-2">Visualizza
                                        tutti i {{ $content['title'] }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Aggiungi una nuova entità -->
        <div class="card mb-5">
            <div class="card-header fs-3">Aggiungi una nuova entità</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    @foreach ($contents_cards_edit as $content)
                        <div class="col">
                            <div class="card h-100">
                                <img src="storage/site_image/{{ $content['img'] }}" class="card-img-top"
                                    alt="{{ $content['title'] }}" style="object-fit: cover; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">{{ $content['title'] }}</h4>
                                    <p class="card-text flex-grow-1">{{ $content['text'] }}</p>
                                    <a href="{{ route($content['route']) }}" class="btn btn-outline-warning mt-2">Aggiungi un
                                        nuovo {{ $content['title'] }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
