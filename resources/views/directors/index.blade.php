<h1>Io sono index di Directors</h1>
<a href="{{route("directors.create")}}">Aggiungi un nuovo Regista</a>
@foreach ($directors as $director)
    <h3>{{ $director->name }} {{ $director->surname }}</h3>
    <p>
        <span>{{ $director->date_of_birth }}</span>
        <span>{{ $director->nationality }}</span>
    </p>
    <p>{{$director->description}}</p>
    <a href="{{route("directors.show", $director->id)}}">Visualizza Regista</a>
@endforeach