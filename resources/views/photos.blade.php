@extends("template")

@section('content')

    <div>
        <h2>Toutes nos photos</h2>
        <div class="sort_photos">

        </div>
    </div>

    <ul class="album-photos">
        @foreach($photos as $a)
            <li class="album-photo">
                <img src="{{$a->url}}" alt="" onclick="afficherImageEnGrand('{{$a->url}}', '{{$a->titre}}', '{{$a->titre}}')">
                <div class="info-tooltip">
                    @foreach($a->tags as $tag)
                        <span class="tags_btn">{{$tag->nom}}</span>
                    @endforeach
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
@endsection

@section('js')
    <script src="{{ asset('js/zoom.js')}}"></script>
@endsection
