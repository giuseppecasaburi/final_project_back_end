<h1>Io sono show di Directors</h1>

<h3>{{ $director->name }} {{ $director->surname }}</h3>

@if ($director->image != null)
    <div>
        <img src="{{ asset("storage/" . $director->image) }}" style="width: 20%" alt="">
    </div>
@endif

<p>
    <span>{{ $director->date_of_birth }}</span>
    <span>{{ $director->nationality }}</span>
</p>

<p>{{ $director->description }}</p>

<a href="{{ route("directors.edit", $director->id) }}">Modifica Regista</a>
<a href="{{ route("directors.index") }}">Torna alla home</a>

<form action="{{ route("directors.destroy", $director->id) }}" method="POST">
    @csrf
    @method("DELETE")

    <button type="submit">Elimina Regista</button>

</form>
