@extends("template")

@section('content')

    <div class="titre_album">
        <h2>{{$album->titre}}</h2>
        <a href="{{'/editalbum/' . $album->id }}">Editer cet album</a>
    </div>

    <form action="{{ url('/album/'.$album->id) }}" method="GET">
        <label for="tag_id">Filtrer par étiquette:</label>
        <select name="tag_id" id="tag_id">
            <option value="">Toutes les étiquettes</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->nom }}</option>
            @endforeach
        </select>

        <label for="search_title">Rechercher par titre:</label>
        <input type="text" name="search_title" id="search_title">
        <div>
            <label for="sort">Trier les résultats par:</label>
            <select name="sort" id="sort">
                <option value="">Trier les resultats</option>
                <option value="note">Note</option>
                <option value="titre">Titre</option>
            </select>
        </div>
        <button type="submit">Filtrer</button>
    </form>

    @if(empty($photos))
        <h2 class="not_found">
            Pas de résultat pour cet album
        </h2>
    @else
        <ul class="album-photos">
            @foreach($photos as $a)
                <li class="album-photo">
                    <img src="{{$a->url}}" alt="" onclick="afficherImageEnGrand('{{$a->url}}', '{{$a->titre}}', '{{$a->titre}}')">
                    <div class="info-tooltip">
                        <div class="tags">
                            @foreach($a->tags as $tag)
                                <span class="tags_btn">{{$tag->nom}}</span>
                            @endforeach
                        </div>
                        <h3>{{$a->titre}}</h3>
                        <p class="rate">
                            @for ($i = 0; $i < $a->note; $i++)
                                ⭐
                            @endfor
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

@section('js')
    <script src="{{ asset('js/zoom.js')}}"></script>
@endsection
