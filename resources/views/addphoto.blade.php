@extends("template")

@section('content')

    <div class="titre_album">
        <h2>{{$album->titre}}</h2>
    </div>

    <form action='/addphotoT' method='post'>
      @csrf
      <input type="text" name='title' placeholder="Titre de votre photo" require>
      <input type="url" name='url' placeholder="Url vers votre photo" require>
      <input type="number" name="note" min="1" max="5" value="1" require/>
      <input type="hidden" name="album_id" value="{{$album->id}}" require />
      <input type='submit' name='Ajouter photo' value='Ajouter photo'>
    </form>

@endsection
