@extends("template")

@section('content')

    <h2>{{$album->titre}}</h2>

    <ul class="album-photos">
        @foreach($photos as $a)
            <img src={{$a->url}} alt="">
        @endforeach
    </ul>
@endsection
