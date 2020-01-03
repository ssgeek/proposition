@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Update Users
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
    <form method="post" action="{{ route('user.update', $user->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="nom">nom:</label>
              <input type="text" class="form-control" name="nom" value="{{ $user->nom }}"/>
          </div>
          <div class="form-group">
              <label for="prenom">Prenom :</label>
              <input type="text" class="form-control" name="prenom" value="{{ $user->prenom }}"/>
          </div>
          <div class="form-group">
              <label for="statut">Statut :</label>
              <input type="text" class="form-control" name="statut" value="{{ $user->statut }}"/>
          </div>
          <div class="form-group">
              <label for="email">E-mail :</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
          </div>
          <div class="form-group">
              <label for="telephone">E-mail :</label>
              <input type="text" class="form-control" name="telephone" value="{{ $user->telephone }}"/>
          </div>
          <div class="form-group">
              <label for="password">Mot de passe :</label>
              <input type="text" class="form-control" name="password" value="{{ $user->password }}"/>
          </div>
          <button type="submit" class="btn btn-primary">MAJ Utilisateur</button>
      </form>
  </div>
</div>
@endsection