@extends("template")

@section('content')

    <h2>Les Albums</h2>

    <form action="{{ url('/albums/') }}" method="GET">
        <div>
            <label for="search_date">Trier par date:</label>
            <select name="search_date" id="search_date">
                <option value="">Trier par date</option>
                <option value="ASC">Croissant</option>
                <option value="DESC">Décroissant</option>
            </select>
        </div>
        <label for="search_title">Rechercher par titre:</label>
        <input type="text" name="search_title" id="search_title">
        <button type="submit">Filtrer</button>
    </form>

    <ul class="albums-list">
        @foreach($albums as $a)
            <li><a href='/album/{{$a->id}}' class="lien_album">{{$a->titre}}</a></li>
        @endforeach
    </ul>
@endsection
