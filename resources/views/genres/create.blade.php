@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mt-4 mb-2">Aggiungi un nuovo Genere</h2>
            <form action="{{ route('genre.store') }}" method="POST" class="p-lg-3">
                @csrf

                @if (request()->has('from'))
                    <input type="hidden" value="{{ request('from') }}" name="from" id="">
                @endif

                <div>
                    <label for="name">Genere</label>
                    <input type="text" name="name" id="" placeholder="Horror" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="color">Colore HEX</label>
                    <input type="text" name="color" id="" placeholder="#fa5000" required maxlength="7">
                    @error('color')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-warning w-25 mt-5 w-lg-100">Aggiungi</button>
            </form>
            {{-- LINK TORNA ALLA HOME --}}
            <div class="mt-2 text-center">
                <a href="{{ route('genre.index') }}" class="btn btn-outline-secondary w-25 w-lg-100">Torna alla
                    home</a>
            </div>

        </div>
    </div>
@endsection