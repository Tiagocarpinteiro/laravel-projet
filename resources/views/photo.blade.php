@extends("template")

@section('content')

<h1>Ajout d'une photo </h1>


@if ($errors->any())
<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
@endif

<form methode="POST" action="/photo/store">
@csrf
  <label>annee: <imput type="numeric" name="annee"></label>
  <label>Titre: <imput type="text" name="titre"></label>
  <label>spec: <imput type="numeric" name="spectateur"></label>

  <label> Type de photo
    <select name="type">
      <option value="">--Please choose an option--</option>
      @foreach ($type as $t)
      <option value={{"$t->id"}}>{{$t->type}}</option>
      @endforeach
    </select>
  </label>

    <imput type="submit" name="ajouter" value="Ajouer un film">


</form>

@endsection
