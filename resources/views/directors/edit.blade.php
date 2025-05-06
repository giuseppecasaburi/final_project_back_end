<h1>Io sono edit di Directors</h1>
<h2>Modifica regista</h2>

<form action="{{route("directors.update", $director->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" id="" required placeholder="Quentin" value="{{$director->name}}">
    </div>

    <div>
        <label for="surname">Cognome</label>
        <input type="text" name="surname" id="" required placeholder="Tarantino" value="{{$director->surname}}">
    </div>

    <div>
        <label for="date_of_birth">Data di nascita</label>
        <input type="date" name="date_of_birth" id="" required value="{{$director->date_of_birth}}">
    </div>

    <div>
        <label for="nationality">Nazionalità</label>
        <input type="text" name="nationality" id="" required placeholder="Statunitense" value="{{$director->nationality}}">
    </div>

    <div>
        <label for="description">Descrizione del regista</label>
        <textarea name="description" id="" cols="30" rows="10" required placeholder="Noto autore dei film...">{{$director->description}}</textarea>
    </div>

    <div>
        <label for="image">Immagine dell'autore</label>
        <input type="file" name="image" id="">

        @if ($director->image)
            <img src="{{asset("storage/" . $director->image)}}" alt="" style="width:10%">
        @endif
    </div>
    <button type="submit">Modifica</button>
</form>
<a href="{{route("directors.index")}}">Annulla</a>