<!-- jQuery (obbligatorio per Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<h1>Io sono la edit di Movies</h1>
<form action="{{route("movies.update", $movie->id)}}" method="POST" enctype="multipart/form-data">
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

    <div class="">
        <label for="genres">Genere</label>
        <select name="genres[]" multiple class="form-control select2" id="">
            @foreach ($genres as $genre)
                <option value="{{$genre->id}}" {{$movie->genres->contains($genre->id) ? "selected" : ""}}>{{$genre->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="">
        <label for="image">Sostituisci la locandina</label>
        <input type="file" name="image" id="">

        @if($movie->image)
            <img src="{{asset("storage/" . $movie->image)}}" alt="locandina" style="width: 10%">
            <label for="remove">Rimuovi la locandina</label>
            <input type="checkbox" name="remove" id="" value="1">
        @endif
    </div>

    <button type="submit">Modifica Film</button>

</form>
<a href="{{route("movies.show", $movie->id)}}">Annulla</a>

<script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Seleziona uno o più generi"
      });
    });
</script>