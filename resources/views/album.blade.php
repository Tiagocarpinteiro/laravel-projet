@extends("template")

@section('content')

    <h2>{{$album->titre}}</h2>

    <ul class="album-photos">
        @foreach($photos as $a)
            <li class="album-photo">
                <img src="{{$a->url}}" alt="" onclick="afficherImageEnGrand('{{$a->url}}', '{{$a->titre}}', '{{$a->titre}}')">
                <div class="info-tooltip">
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
