@extends("template")

@section('content')

  <h2>Les Albums</h2>

<ul class="albums-list">
@foreach($albums as $a)
  <li><a href='/album/{{$a->id}}'>{{$a->titre}}</a></li>
@endforeach
</ul>
@endsection
