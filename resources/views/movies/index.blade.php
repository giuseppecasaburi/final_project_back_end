<h1>Io sono la index dei movies</h1>
<a href="{{route("movies.create")}}">Aggiungi un nuovo film</a>
@foreach ($movies as $movie)
    <h3>{{$movie->title}}</h3>
    <span>Durata: {{$movie->duration}}</span><br>
    <a href="{{route("movies.show", $movie->id)}}">Visualizza dettagli</a>
    <hr>
@endforeach