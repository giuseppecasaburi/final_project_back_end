@extends('layouts.app')

<!-- jQuery (obbligatorio per Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@section('content')

    <div class="d-sm-flex d-block">
        <div class="filter d-block d-sm-flex flex-column p-3">
            <form action="" method="POST" enctype="multipart/form-data">
                <h3>Aggiungi Filtri</h3>
                <h5 class="d-block">Filtra per Genere</h5>
                <div class="p-2">
                    @foreach ($genres as $genre)
                        <span class="d-none d-sm-block pb-2 px-2">
                            <input type="checkbox">
                            <label for="">{{ $genre->name }}</label>
                        </span>
                    @endforeach
                    <div class="select">
                        <select name="genres[]" multiple class="form-control select2" id="">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ old('genre_id', session('new_genre_id')) == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h5>Filtra per Regista</h5>
                <div class="p-2">
                    @foreach ($directors_list as $director)
                        <span class="d-none d-sm-block pb-2 px-2">
                            <input type="checkbox">
                            <label for="">{{ $director->name }} {{ $director->surname }}</label>
                        </span>
                    @endforeach
                    <div class="select">
                        <select name="genres[]" multiple class="d-sm-none form-control select2" id="">
                            @foreach ($directors_list as $director)
                                <option value="{{ $director->id }}"
                                    {{ old('genre_id', session('new_genre_id')) == $director->id ? 'selected' : '' }}>
                                    {{ $director->name }} {{ $director->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-warning mt-3">Applica filtri</button>
            </form>
        </div>
        <div class="content p-3">
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
</div>

<script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Seleziona uno o più filtri"
      });
    });
</script>