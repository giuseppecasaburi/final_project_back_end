<!-- jQuery (obbligatorio per Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<h1>Io sono la create di Movies</h1>
<form action="{{route("movies.store")}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="" required>
    </div>

    <div class="">
        <label for="story">Trama</label>
        <textarea name="story" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="">
        <label for="year_of_publication">Anno di uscita</label>
        <input type="date" name="year_of_publication" id="" required>
    </div>

    <div class="">
        <label for="duration">Durata</label>
        <input type="number" min="50" max="200" name="duration" id="">
        <span>minuti</span>
    </div>

    <div class="">
        <label for="genres">Genere</label>
        <select name="genres[]" multiple class="form-control select2" id="">
            @foreach ($genres as $genre)
                <option value="{{$genre->id}}"
                        {{old("genre_id", session("new_genre_id")) == $genre->id ? "selected" : ""}}    
                >{{$genre->name}}</option>
            @endforeach
        </select>
        <div>
            <a href="{{route("genre.create", ["from" => "movies.create"])}}">Aggiungi un nuovo Genere</a>
        </div>
    </div>

    <div>
        <select name="director_id" id="">
            <option value="">Seleziona un regista</option>
            @foreach ($directors as $director)
                <option value="{{$director->id}}"
                    {{old("director_id", session("new_director_id")) == $director->id ? "selected" : ""}}
                    >{{$director->name}} {{$director->surname}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <a href="{{route("directors.create", ["from" => "movies.create"])}}">Aggiungine uno nuovo</a>
    </div>

    <div class="">
        <label for="image">Locandina</label>
        <input type="file" name="image" id="">
    </div>

    <button type="submit">Aggiungi Film</button>

</form>

<script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Seleziona uno o più generi"
      });
    });
</script>