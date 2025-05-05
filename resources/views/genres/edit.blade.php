<h1>Io sono la edit di Genre</h1>
<form action="{{route("genre.update", $genre->id)}}" method="POST">
    @csrf
    @method("PUT")

    <div>
        <label for="name">Genere</label>
        <input type="text" name="name" id="" value="{{$genre->name}}" required>
    </div>

    <div>
        <label for="color">Colore HEX</label>
        <input type="text" name="color" id="" required maxlength="7" value="{{$genre->color}}">
    </div>

    <button type="submit">Modifica</button>
</form>
<a href="{{route("genre.index")}}">Annulla</a>