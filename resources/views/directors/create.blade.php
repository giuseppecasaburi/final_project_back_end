<h1>Io sono create di Directors</h1>
<h2>Aggiungi un nuovo regista</h2>

<form action="{{route("directors.store")}}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Necessario per poter indicare da dove arriva l'utente --}}
    @if (request()->has("from"))
        <input type="hidden" name="from" id="" value="{{request("from")}}">
    @endif

    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" id="" required placeholder="Quentin">
    </div>

    <div>
        <label for="surname">Cognome</label>
        <input type="text" name="surname" id="" required placeholder="Tarantino">
    </div>

    <div>
        <label for="date_of_birth">Data di nascita</label>
        <input type="date" name="date_of_birth" id="" required>
    </div>

    <div>
        <label for="nationality">Nazionalità</label>
        <input type="text" name="nationality" id="" required placeholder="Statunitense">
    </div>

    <div>
        <label for="description">Descrizione del regista</label>
        <textarea name="description" id="" cols="30" rows="10" required placeholder="Noto autore dei film..."></textarea>
    </div>

    <div>
        <label for="image">Immagine dell'autore</label>
        <input type="file" name="image" id="">
    </div>
    <button>Aggiungi</button>
</form>
<a href="{{route("directors.index")}}">Annulla</a>