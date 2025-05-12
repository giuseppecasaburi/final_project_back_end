@extends('layouts.app')

<!-- jQuery (obbligatorio per Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@section('content')
    <div class="container">
        <div class="form-container">
            <h2 class="text-center my-4">Aggiungi un nuovo Film</h2>
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="" required class="w-50">
                </div>

                <div class="">
                    <label for="story">Trama</label>
                    <textarea name="story" id="" cols="30" rows="10" class="w-50"></textarea>
                </div>

                <div class="">
                    <label for="year_of_publication">Anno di uscita</label>
                    <input type="date" name="year_of_publication" id="" required class="w-50">
                </div>

                <div class="">
                    <label for="duration">Durata (espressa in minuti)</label>
                    <input type="number" min="50" max="200" name="duration" id="" class="w-50">
                </div>

                <div class="">
                    <label for="genres">Genere</label>
                    <select name="genres[]" multiple class="form-control select2 w-50" id="">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ old('genre_id', session('new_genre_id')) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <div>
                        <span class="d-block mt-3 mb-2">Manca il tuo genere?</span>
                        <button class="btn btn-outline-warning"><a
                                href="{{ route('genre.create', ['from' => 'movies.create']) }}">Aggiungine uno
                                nuovo</a></button>
                    </div>
                </div>

                <div>
                    <select name="director_id" id="" class="w-50">
                        <option value="">Seleziona un regista</option>
                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}"
                                {{ old('director_id', session('new_director_id')) == $director->id ? 'selected' : '' }}>
                                {{ $director->name }} {{ $director->surname }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <span class="d-block mt-3 mb-2">Manca il tuo regista?</span>
                    <button class="btn btn-outline-warning"><a
                            href="{{ route('directors.create', ['from' => 'movies.create']) }}">Aggiungine uno
                            nuovo</a></button>
                </div>

                <div class="">
                    <label for="image">Locandina</label>
                    <input type="file" name="image" id="" class="w-50">
                </div>

                <button type="submit">Aggiungi Film</button>

            </form>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleziona uno o più generi"
        });
    });
</script>
