<h1>Io sono la create dei Genres</h1>
<form action="{{route("genre.store")}}" method="POST">
    @csrf

    @if (request()->has("from"))
        <input type="hidden" value="{{request("from")}}" name="from" id="">
    @endif

    <div>
        <label for="name">Genere</label>
        <input type="text" name="name" id="" required>
    </div>

    <div>
        <label for="color">Colore HEX</label>
        <input type="text" name="color" id="" required maxlength="7">
    </div>

    <button type="submit">Aggiungi</button>
</form>