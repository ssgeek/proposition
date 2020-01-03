@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Ajouter des Commerciaux
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('user.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Nom:</label>
              <input type="text" class="form-control" name="nom"/>
          </div>
          <div class="form-group">
              <label for="price">Prenom :</label>
              <input type="text" class="form-control" name="prenom"/>
          </div>
          <div class="form-group">
              <label for="quantity">Statut :</label>
              <input type="text" class="form-control" name="statut"/>
          </div>
          <div class="form-group">
              <label for="price">E-mail :</label>
              <input type="text" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="quantity">Téléphone :</label>
              <input type="text" class="form-control" name="telephone"/>
          </div>
          
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </form>
  </div>
</div>
@endsection