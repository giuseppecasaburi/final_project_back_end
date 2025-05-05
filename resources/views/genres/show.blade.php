<h1>Io sono la show di Genre</h1>
<h2>{{ $genre->name }}</h2>
<p>Colore: {{ $genre->color }}</p>
<a href="{{ route('genre.edit', $genre->id) }}">Modifica</a>
<form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Elimina</button>
</form>
<a href="{{ route('genre.index') }}">Torna in home</a>
