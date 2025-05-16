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
            <h2 class="text-center my-4">Modifica il film: {{ $movie->title }}</h2>
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="w-50 w-lg-100 mx-auto">
                    <select name="director_id" id="" class="w-100">
                        <option value="">Seleziona un regista</option>
                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}"
                                {{ $movie->director_id == $director->id ? 'selected' : '' }}>{{ $director->name }}
                                {{ $director->surname }}</option>
                        @endforeach
                    </select>
                    <div class="">
                        <span class="d-block mb-2">Manca il tuo regista?</span><a class="d-block btn btn-outline-warning"
                            href="{{ route('directors.create', ['from' => 'movies.create']) }}">Aggiungine uno
                            nuovo</a>
                    </div>
                </div>

                <div class="">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="" class="w-50 w-lg-100" value="{{ $movie->title }}"
                        required>
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="story">Trama</label>
                    <textarea name="story" id="" cols="30" rows="10" class="w-50 w-lg-100" required>{{ $movie->story }}</textarea>
                    @error('story')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="year_of_publication">Anno di uscita</label>
                    <input type="date" name="year_of_publication" id=""
                        value="{{ $movie->year_of_publication }}" class="w-50 w-lg-100" required>
                    @error('year_of_publication')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="duration">Durata (espressa in minuti)</label>
                    <input type="number" min="50" max="200" name="duration" id="" class="w-50 w-lg-100"
                        value="{{ $movie->duration }}" required>
                    @error('duration')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-50 w-lg-100 mx-auto">
                    <label for="genres">Genere</label>
                    <select name="genres[]" multiple class="form-control select2" id="" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ $movie->genres->contains($genre->id) ? 'selected' : '' }}>
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

                <div class="">
                    <label for="review">Recensione</label>
                    @if ($movie->review)
                        <textarea name="review" id="" cols="30" rows="10" class="w-50 w-lg-100">{{ $movie->review }}</textarea>
                    @else
                        <textarea name="review" id="" cols="30" rows="10" class="w-50 w-lg-100"
                            placeholder="Nessuna recensione presente."></textarea>
                    @endif

                    @error('review')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="vote">Voto</label>
                    <input type="number" min="1" max="10" name="vote" id="" class="w-50 w-lg-100"
                        value="{{ $movie->vote }}" placeholder="Numero intero da 1 a 10">
                    @error('vote')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="upload-image">
                    <p>Sostituisci locandina</p>

                    <!-- Locandina attuale con X -->
                    @if ($movie->image)
                        <p class="mb-1">Locandina attuale:</p>
                        <div id="existingImageContainer" class="mb-2 mt-0 position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $movie->image) }}" alt="locandina" style="width: 150px;"
                                class="rounded shadow">

                            <!-- Pulsante X -->
                            <button type="button" id="removeExistingImage" class="btn btn-danger position-absolute"
                                style="top: 0; right: 0; width: 25px; height: 25px; padding: 0; font-size: 16px; line-height: 1;">
                                &times;
                            </button>
                        </div>
                    @else
                        <p class="text-muted">Nessuna immagine caricata</p>
                    @endif

                    <!-- Campo hidden per segnalare la rimozione -->
                    <input type="hidden" name="remove_image" id="removeImageField" value="0">

                    <!-- Errori -->
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Anteprima nuova immagine -->
                    <div id="previewContainer" class="my-0 d-none">
                        <div class="my-0 position-relative" style="display: inline-block;">
                            <img id="imagePreview" src="" class="img-fluid rounded shadow" style="width: 150px;"
                                alt="Anteprima immagine">
                            <button type="button" id="removeImage" class="btn btn-danger position-absolute"
                                style="top: 5px; right: 5px; width: 25px; height: 25px; padding: 0; font-size: 16px; line-height: 1;">
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- Input file nascosto -->
                    <input type="file" id="image" name="image" accept="image/*" class="d-none">

                    <!-- Bottone per selezionare -->
                    <label for="image" class="btn btn-outline-warning w-25 w-lg-100 mt-2">Scegli immagine</label>
                </div>

                <button type="submit" class="btn btn-outline-warning w-25 me-lg-2 mt-lg-5 w-lg-100">Modifica
                    Film</button>
                <a href="{{ route('movies.show', $movie->id) }}"
                    class="btn btn-outline-secondary w-25 mt-3 mt-lg-5 w-lg-100">Annulla</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Rimuovi immagine esistente via X
            const removeExistingBtn = document.getElementById('removeExistingImage');
            const existingContainer = document.getElementById('existingImageContainer');
            const removeField = document.getElementById('removeImageField');

            if (removeExistingBtn && existingContainer && removeField) {
                removeExistingBtn.addEventListener('click', () => {
                    existingContainer.remove();
                    removeField.value = "1";
                });
            }

            // 2. Anteprima nuova immagine (e rimozione della vecchia se ne selezioni una nuova)
            const inputFile = document.getElementById('image');
            const previewImg = document.getElementById('imagePreview');
            const previewWrap = document.getElementById('previewContainer');
            const removePreviewBtn = document.getElementById('removeImage');

            if (inputFile && previewImg && previewWrap && removePreviewBtn) {
                inputFile.addEventListener('change', function() {
                    // **Rimuovo automaticamente l'esistente al caricamento della nuova**
                    if (existingContainer) {
                        existingContainer.remove();
                        removeField.value = "1";
                    }

                    // Mostro la nuova preview
                    const file = this.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            previewImg.src = e.target.result;
                            previewWrap.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });

                removePreviewBtn.addEventListener('click', () => {
                    inputFile.value = '';
                    previewImg.src = '';
                    previewWrap.classList.add('d-none');
                });
            }

            // 3. Inizializza Select2
            $('.select2').select2({
                placeholder: "Seleziona uno o più generi",
                width: "100%"
            });
        });
    </script>
@endsection