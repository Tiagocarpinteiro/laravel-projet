@extends("template")

@section('content')

    <div class="titre_album">
        <h2>{{$album->titre}}</h2>
        <a href="{{'/album/' . $album->id }}">Retourner a l'album</a>
        <a href="{{'/addphoto/' . $album->id }}">Ajouter une photo</a>
    </div>

    <table>

        <thead>
        <tr>
            <th>Id</th>
            <th>Url</th>
            <th>Note</th>
            <th>Supprimer</th>
        </tr>
        </thead>

        @foreach($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td class="table_url">{{$photo->url}}</td>
                <td>
                    @for ($i = 0; $i < $photo->note; $i++)
                            ⭐
                        @endfor
                </td>
                <td><a href="{{'/deletephoto/' . $album->id . '/' . $photo->id }}" >🗑️</a></td>
            </tr>
        @endforeach

    </table>

@endsection


