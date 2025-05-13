@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-container">
            <h2 class="text-center my-4">Aggiungi un nuovo regista</h2>

            <form action="{{ route('directors.store') }}" method="POST" enctype="multipart/form-data" class="p-lg-3">
                @csrf

                {{-- Necessario per poter indicare da dove arriva l'utente --}}
                @if (request()->has('from'))
                    <input type="hidden" name="from" id="" value="{{ request('from') }}">
                @endif

                <div>
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="" required placeholder="Quentin" class="w-50 w-lg-100"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="surname">Cognome</label>
                    <input type="text" name="surname" id="" required placeholder="Tarantino"
                        class="w-50 w-lg-100" value="{{ old('surname') }}">
                    @error('surname')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="date_of_birth">Data di nascita</label>
                    <input type="date" name="date_of_birth" id="" required class="w-50 w-lg-100"
                        value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nationality">Nazionalità</label>
                    <input type="text" name="nationality" id="" required placeholder="Statunitense"
                        class="w-50 w-lg-100" value="{{ old('nationality') }}">
                    @error('nationality')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="description">Descrizione del regista</label>
                    <textarea name="description" id="" cols="30" rows="10" required placeholder="Noto autore dei film..."
                        class="w-50 w-lg-100">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <div class="upload-image">
                        <p>Immagine Regista</p>
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
                </div>
                <button type="submit" class="btn btn-outline-warning w-25 mt-5 w-lg-100">Aggiungi Regista</button>
            </form>
            {{-- LINK TORNA ALLA HOME --}}
            <div class="mt-3 text-center">
                <a href="{{ route('directors.index') }}" class="btn btn-outline-secondary w-25 mt-5 w-lg-100">Torna alla
                    home</a>
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
@endsection
