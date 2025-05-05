<h1>Io sono la index dei Genre</h1>
<a href="{{ route('genre.create') }}">Aggiungi un nuovo genere</a>
@foreach ($genres as $genre)
    <h2>Genere: {{ $genre->name }}</h2>
    <p>Colore: {{ $genre->color }}</p>
    <a href="{{ route('genre.edit', $genre->id) }}">Modifica</a>
    <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>
@endforeach
