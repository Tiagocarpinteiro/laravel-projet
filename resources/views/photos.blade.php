@extends("template")

@section('content')

  <h2>Photo de l'album</h2>

<ul>

  @foreach($photos as $photo)
  @if($photos->album_id == {{$a->id}})


    <li><img src={{$photo->url}}></li>
  @endforeach



</ul>
@endsection


boucle albumS pour choisir l'ID de l'album
  recupère l'ID de l'album pour trier les photos
    afficher les photos PAR RAPPORT À L'ID
