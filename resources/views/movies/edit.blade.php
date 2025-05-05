<h1>Io sono la edit di Movies</h1>
<form action="{{route("movies.update", $movie->id)}}" method="POST">
    @csrf
    @method("PUT")

    <div class="">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="" value="{{$movie->title}}" required>
    </div>

    <div class="">
        <label for="story">Trama</label>
        <input type="text" name="story" id="" value="{{$movie->story}}" required>
    </div>

    <div class="">
        <label for="year_of_publication">Anno di uscita</label>
        <input type="date" name="year_of_publication" id="" value="{{$movie->year_of_publication}}" required>
    </div>

    <div class="">
        <label for="duration">Durata</label>
        <input type="number" min="50" max="200" name="duration" id="" value="{{$movie->duration}}" required>
        <span>minuti</span>
    </div>

    <button type="submit">Modifica Film</button>

</form>