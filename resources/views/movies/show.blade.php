<h1>Io sono la show dei movies</h1>
    <h3>{{ $movie->title }}</h3>
    @if ($movie->image)
        <div >
            <img src="{{asset("storage/" . $movie->image)}}" style="width: 10%" alt="locandina del film">
        </div>
    @endif
    <p>Storia: {{ $movie->story }}</p>
    <p>Anno di pubblicazione: {{ $movie->year_of_publication }}</p>
    <span>Durata: {{ $movie->duration }}</span><br>
    <a href="{{ route('movies.edit', $movie->id) }}">Modifica Movie</a>
    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit">Elimina Movie</button>
    </form>
    <a href="{{ route('movies.index') }}">Torna alla home</a>
    <hr>
