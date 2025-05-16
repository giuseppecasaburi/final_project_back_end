@extends('layouts.app')
@section('content')
    <div class="container my-3">
        <h2 class="mb-4 d-flex flex-column flex-sm-row align-items-center">Catalogo Registi <a href="{{route('directors.create')}}" class="btn btn-outline-warning ms-0 mt-3 mt-sm-0 ms-sm-3">Aggiungi un Regista</a></h2>
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($directors as $director)
                <div class="col">
                    <div class="card h-100 d-flex flex-column">
                        @if ($director->image)
                            <img src="{{ asset('storage/' . $director->image) }}" class="card-img-top"
                                alt="{{ $director->title }}" style="object-fit: cover; height: 400px;">
                        @else
                            <div style="height: 400px; color: #ffa500" class="justify-content-center d-flex align-items-center">Nessuna immagine collegata</div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">{{ $director->name }} {{ $director->surname }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p>{{ Str::limit(strip_tags($director->description), 100) }} <br><i style="color: #ffa500">Clicca qui sotto per continuare a leggere</i></p>
                            <a href="{{ route('directors.show', $director->id) }}"
                                class="btn btn-outline-warning mt-auto">Visualizza Regista</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">{{ $directors->links() }}</div>
    </div>
@endsection