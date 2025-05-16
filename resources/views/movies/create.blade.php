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
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="p-lg-3">
                @csrf

                <div class="w-50 w-lg-100 mx-auto">
                    <select name="director_id" id="" class="w-100" required>
                        <option value="">Seleziona un regista</option>
                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}"
                                {{ old('director_id', session('new_director_id')) == $director->id ? 'selected' : '' }}>
                                {{ $director->name }} {{ $director->surname }}</option>
                        @endforeach
                    </select>
                    <div>
                        <span class="d-block mb-2">Manca il tuo regista?</span><a class="d-block btn btn-outline-warning"
                            href="{{ route('directors.create', ['from' => 'movies.create']) }}">Aggiungine uno
                            nuovo</a>
                    </div>
                </div>

                <div class="">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="" required class="w-50 w-lg-100"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="story">Trama</label>
                    <textarea name="story" id="" cols="30" rows="10" class="w-50 w-lg-100" required>{{ old('story') }}</textarea>
                    @error('story')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="year_of_publication">Anno di uscita</label>
                    <input type="date" name="year_of_publication" id="" required class="w-50 w-lg-100"
                        value="{{ old('year_of_publication') }}">
                    @error('year_of_publication')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="duration">Durata (espressa in minuti)</label>
                    <input type="number" min="50" max="200" name="duration" id="" class="w-50 w-lg-100"
                        required value="{{ old('duration') }}">
                    @error('duration')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-50 w-lg-100 mx-auto">
                    <label for="genres">Genere</label>
                    <select name="genres[]" multiple class="form-control select2" id="" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                {{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genres')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <div>
                        <span class="d-block mb-2">Manca il tuo genere?</span>
                        <a class="btn btn-outline-warning d-block"
                            href="{{ route('genre.create', ['from' => 'movies.create']) }}">Aggiungine uno
                            nuovo</a>
                    </div>
                </div>

                <div>
                    <label for="review">Recensione</label>
                    <textarea name="review" id="" cols="30" rows="10" class="w-50 w-lg-100">{{ old('review') }}</textarea>
                    @error('review')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="vote">Voto</label>
                    <input type="number" min="1" max="10" name="vote" id="" class="w-50 w-lg-100"
                        value="{{ old('vote') }}">
                    @error('vote')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="upload-image">
                    <p>Locandina</p>
                    <!-- Anteprima immagine -->
                    <div id="previewContainer" class="mt-3 d-none">
                        <div class="position-relative" style="display: inline-block;">
                            <img id="imagePreview" src="" class="img-fluid rounded shadow" style="width: 150px;"
                                alt="Anteprima immagine">
                            <button type="button" id="removeImage" class="btn btn-danger position-absolute"
                                style="top: 5px; right: 5px; width: 25px; height: 25px; padding: 0; font-size: 16px; line-height: 1;">
                                &times;
                            </button>
                        </div>
                    </div>

                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Input file nascosto -->
                    <input type="file" id="image" name="image" accept="image/*" class="d-none">

                    <!-- Bottone personalizzato -->
                    <label for="image" class="btn btn-outline-warning w-25 w-lg-100">Scegli immagine</label>
                </div>

                <button type="submit" class="btn btn-outline-warning w-25 mt-5 w-lg-100">Aggiungi Film</button>
            </form>
            {{-- LINK TORNA ALLA HOME --}}
            <div class="mt-2 text-center">
                <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary w-25 w-lg-100">Torna alla home</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const image = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');
        const removeImage = document.getElementById('removeImage');

        image.addEventListener('change', function() {
            const file = this.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        removeImage.addEventListener('click', function() {
            image.value = '';
            imagePreview.src = '';
            previewContainer.classList.add('d-none');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleziona uno o più generi",
                width: "100%"
            });
        });
    </script>
@endsection
