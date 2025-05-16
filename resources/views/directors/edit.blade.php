@extends('layouts.app')
@section('title', "Modifica " . $director->name . " " . $director->name)

@section('content')
    <div class="container">
        <div class="form-container">
            <h2 class="text-center my-4">Modifica il regista: {{ $director->name }} {{ $director->surname }}</h2>
            <form action="{{ route('directors.update', $director->id) }}" method="POST" enctype="multipart/form-data"
                class="pb-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="" class="w-50 w-lg-100" required placeholder="Quentin"
                        value="{{ $director->name }}">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="surname">Cognome</label>
                    <input type="text" name="surname" id="" class="w-50 w-lg-100" required
                        placeholder="Tarantino" value="{{ $director->surname }}">
                    @error('surname')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="date_of_birth">Data di nascita</label>
                    <input type="date" name="date_of_birth" id="" required
                        value="{{ $director->date_of_birth }}" class="w-50 w-lg-100">
                    @error('date_of_birth')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nationality">Nazionalità</label>
                    <input type="text" name="nationality" id="" required placeholder="Statunitense"
                        value="{{ $director->nationality }}" class="w-50 w-lg-100">
                    @error('nationality')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="description">Descrizione del regista</label>
                    <textarea name="description" id="" cols="30" rows="10" required placeholder="Noto autore dei film..."
                        class="w-50 w-lg-100">{{ $director->description }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="upload-image">
                    <p>Sostituisci locandina</p>

                    <!-- Locandina attuale con X -->
                    @if ($director->image)
                        <p class="mb-1">Locandina attuale:</p>
                        <div id="existingImageContainer" class="mb-2 mt-0 position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $director->image) }}" alt="locandina" style="width: 150px;"
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

                <button type="submit" class="btn btn-outline-warning w-25 me-lg-2 mt-lg-5 w-lg-100">Modifica</button>
                <a href="{{ route('directors.index') }}"
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
        });
    </script>
@endsection
