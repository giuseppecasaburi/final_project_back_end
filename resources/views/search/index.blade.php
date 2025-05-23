@extends('layouts.app')
@section('title', 'Search Page')

<!-- jQuery (obbligatorio per Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@section('content')

    <div class="d-sm-flex d-block contenitore">
        <div class="filter d-block d-sm-flex flex-column p-3">
            <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="query_search" value="{{ request('query_search') }}" id="">
                <h3>Aggiungi Filtri</h3>
                <h5 class="d-block">Filtra per Genere</h5>
                <div class="p-2">
                    @foreach ($genresList as $genre)
                        <span class="d-none d-sm-block pb-2 px-2">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }}>
                            <label for="">{{ $genre->name }}</label>
                        </span>
                    @endforeach
                    <div class="select">
                        <select name="genres[]" multiple class="form-control select2" id="">
                            @foreach ($genresList as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ in_array($genre->id, $selectedGenres) ? 'selected' : '' }}>
                                    {{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h5>Filtra per Regista</h5>
                <div class="p-2">
                    @foreach ($directorsList as $director)
                        <span class="d-none d-sm-block pb-2 px-2">
                            <input type="checkbox" name="directors[]" value="{{ $director->id }}"
                                {{ in_array($director->id, $selectedDirectors) ? 'checked' : '' }}>
                            <label for="">{{ $director->name }} {{ $director->surname }}</label>
                        </span>
                    @endforeach
                    <div class="select">
                        <select name="directors[]" multiple class="d-sm-none form-control select2" id="">
                            @foreach ($directorsList as $director)
                                <option value="{{ $director->id }}"
                                    {{ in_array($director->id, $selectedDirectors) ? 'selected' : '' }}>
                                    {{ $director->name }} {{ $director->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-warning mt-3">Applica filtri</button>
                <button class="btn btn-outline-secondary mt-3"><a
                        href="{{ route('search', ['query_search' => request('query_search')]) }}"">Rimuovi
                        filtri</a></button>

            </form>
        </div>
        <div class="content p-3">
            @if ($movies->count() || $directors->count())
                <h3>Risultati trovati: {{ $movies->count() + $directors->count() }}</h3>
                @if ($movies->count())
                    <h4 class="my-3">Film Trovati: {{ $movies->count() }}</h4>
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        @foreach ($movies as $movie)
                            <div class="col">
                                <div class="card h-100 d-flex flex-column">
                                    @if ($movie->image)
                                        <img src="{{ asset('storage/' . $movie->image) }}" class="card-img-top"
                                            alt="{{ $movie->title }}"
                                            style="object-fit: cover; object-position: top; height: 200px;">
                                    @endif
                                    <div class="card-header">
                                        <h4 class="card-title">{{ $movie->title }}</h4>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1">{{ $movie->year_of_publication }}</p>
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
                                        <a href="{{ route('movies.show', $movie->id) }}"
                                            class="btn btn-outline-warning mt-2">Visualizza
                                            Film</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="my-3">Film Trovati: {{ $movies->count() }}</h4>
                @endif

                @if ($directors->count())
                    <h4 class="my-3">Registi Trovati: {{ $directors->count() }}</h4>
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        @foreach ($directors as $director)
                            <div class="col">
                                <div class="card h-100">
                                    @if ($director->image)
                                        <img src="{{ asset('storage/' . $director->image) }}" class="card-img-top"
                                            alt="{{ $director->title }}" style="object-fit: cover; height: 200px;">
                                    @endif
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $director->name }} {{ $director->surname }}</h4>
                                        <a href="{{ route('directors.show', $director->id) }}"
                                            class="btn btn-outline-warning mt-2">Visualizza Regista</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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


    // SCRIPT PER ANNULLARE O ATTIVARE I VARI FORM A SECONDA DELLA DIMENSIONE VIEWPORT
    $(function() {
        function toggleInputs() {
            if ($(window).width() < 576) {
                // in mobile: disabilita checkbox classici, abilita Select2
                $('input[name="genres[]"]').prop('disabled', true);
                $('select[name="genres[]"]').prop('disabled', false);
                $('input[name="directors[]"]').prop('disabled', true);
                $('select[name="directors[]"]').prop('disabled', false);
            } else {
                // in desktop: disabilita Select2, abilita checkbox
                $('input[name="genres[]"]').prop('disabled', false);
                $('select[name="genres[]"]').prop('disabled', true);
                $('input[name="directors[]"]').prop('disabled', false);
                $('select[name="directors[]"]').prop('disabled', true);
            }
        }

        // al caricamento e al resize
        toggleInputs();
        $(window).on('resize', toggleInputs);

        // prima del submit, assicurati di disabilitare ancora
        $('form').on('submit', function() {
            toggleInputs();
        });
    });
</script>
