<h1>Io sono la create di Movies</h1>
<form action="{{route("movies.store")}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="" required>
    </div>

    <div class="">
        <label for="story">Trama</label>
        <input type="text" name="story" id="" required>
    </div>

    <div class="">
        <label for="year_of_publication">Anno di uscita</label>
        <input type="date" name="year_of_publication" id="" required>
    </div>

    <div class="">
        <label for="duration">Durata</label>
        <input type="number" min="50" max="200" name="duration" id="" required>
        <span>minuti</span>
    </div>

    <div class="">
        <label for="image">Locandina</label>
        <input type="file" name="image" id="">
    </div>

    <button type="submit">Aggiungi Film</button>

</form>