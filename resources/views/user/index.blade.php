@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>


<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <table class="table" style="margin-top:50px;margin-bottom:50px;">
    <tr><td><a href="{{ route('user.create')}}"><button type="button" class="btn btn-primary btn-lg btn-block">Ajouter un nouveau utilisateur</button></a></td></tr>
  </table>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nom</td>
          <td>Prenom</td>
          <td>Statut</td>
          <td>E-mail</td>
          <td>Téléphone</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->nom}}</td>
            <td>{{$user->prenom}}</td>
            <td>{{$user->statut}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->telephone}}</td>
            <td><a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('user.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection