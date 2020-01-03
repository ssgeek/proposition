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
    <tr><td><a href="{{ route('proposition.create')}}"><button type="button" class="btn btn-primary btn-lg btn-block">Editer une nouvelle proposition</button></a></td></tr>
  </table>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Commercial</td>
          <td>Client</td>
          <td>Entité</td>
          <td>Interlocuteur</td>
          <td>Date de début</td>
          <td>Grille Tarifaire</td>
          <td>Tarif proposé</td>
          <td colspan="4"><center>Action</center></td>
        </tr>
    </thead>
    <tbody>
        @foreach($propositions as $prop)
        <tr>
            <td>{{$prop->id}}</td>
            <td>{{$prop->nom}} {{$prop->prenom}}</td>
            <td>{{$prop->client}}</td>
            <td>{{$prop->entite_client}}</td>
            <td>{{$prop->interlocuteur}}</td>
            <td>{{$prop->date_debut}}</td>
            <td>{{$prop->tjm}}</td>
            <td>
              @if ($prop->tarif_propose > $prop->tjm) 
                <button class="btn btn-success "> <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> {{$prop->tarif_propose}} </button>
              @elseif ($prop->tarif_propose < $prop->tjm)
                <button class="btn btn-danger"> <ion-icon name="arrow-round-down"></ion-icon> {{$prop->tarif_propose}} </button>
              @else
                <button class="btn btn-info"> <ion-icon name="arrow-round-forward"></ion-icon> {{$prop->tarif_propose}} </button>
              @endif
            
          
          
            </td>
            <td><a href="{{ route('proposition.edit', $prop->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('proposition.show', $prop->id)}}" class="btn btn-success">Consulter</a></td>
            <td>
              @if (!$prop->existTache) 
              <a href="{{ route('proposition.addTache', $prop->id)}}" class="btn btn-success">Ajouter les tâches</a>
              @else
              @endif
            </td>
            <td>
                <form action="{{ route('proposition.destroy', $prop->id)}}" method="post">
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