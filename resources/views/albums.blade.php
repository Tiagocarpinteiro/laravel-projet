@extends("template")

@section('content')

  <h2>Les Albums</h2>

<ul>
@foreach($albums as $a)
  <li><a href='/album/{{$a->id}}'>{{$a->titre}}</a></li>
@endforeach
</ul>
@endsection
