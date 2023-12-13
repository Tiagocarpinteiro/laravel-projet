@extends("template")

@section('content')

    <h2>Les Albums</h2>

    <ul>
        @foreach($album as $a)
            <img src={{$a->url}} alt="">
        @endforeach
    </ul>
@endsection
