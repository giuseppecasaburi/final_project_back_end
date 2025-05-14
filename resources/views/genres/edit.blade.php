
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mt-4 mb-2">Modifica il genere: {{$genre->name}}</h2>
            <form action="{{ route('genre.update', $genre->id) }}" method="POST" class="p-lg-3">
                @csrf
                @method('PUT')

                @if (request()->has('from'))
                    <input type="hidden" value="{{ request('from') }}" name="from" id="">
                @endif

                <div>
                    <div>
                        <label for="name">Genere</label>
                        <input type="text" name="name" id="" value="{{ $genre->name }}" required>
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="color">Colore HEX</label>
                    <input type="text" name="color" id="" required maxlength="7" value="{{ $genre->color }}">
                    @error('color')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-warning w-25 mt-5 w-lg-100">Modifica</button>
            </form>
            {{-- LINK TORNA ALLA HOME --}}
            <div class="mt-2 text-center">
                <a href="{{ route('genre.index') }}" class="btn btn-outline-secondary w-25 w-lg-100">Annulla</a>
            </div>

        </div>
    </div>
@endsection
