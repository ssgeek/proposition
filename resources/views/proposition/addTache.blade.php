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
    <tbody>
        <tr><td>Client</td><td>{{$proposition->client}}</td> </tr>
        <tr><td>Référence</td><td>{{$proposition->reference}}</td> </tr>
        <tr><td>Interlocuteur</td><td>{{$proposition->interlocuteur}}</td> </tr>
        <tr><td>Site</td><td>{{$proposition->site}}</td> </tr>
        <tr><td>Grille tarifaire</td><td>{{$proposition->label}} - {{$proposition->tjm}} €</td> </tr>
        <tr><td>Tarif Proposé</td><td>{{$proposition->tarif_propose}} €</td> </tr>
        <tr><td>Nombre jours ouvré</td><td>{{$proposition->nbJoursOuvre}} Jours</td> </tr>
        <tr><td>Nombre jours gratuits</td><td>{{$proposition->nbre_jours_gratuit}}</td> </tr>
        <tr><td>Nombre jours de congé</td><td>{{$proposition->nbre_jours_conge}}</td> </tr>
        <tr><td>Tarif total</td><td>{{$proposition->tarifFinal}} €</td> </tr>
    </tbody>
  </table>
  <br /><br />
  <form method="post" action="{{ route('tache.store') }}">

    @for ($i = 0; $i < $proposition->nbre_tache; $i++)
                 
          <div class="form-group">
              @csrf
              <input type="hidden" name="proposition_id" value="{{$proposition->id}}">
              <label for="label">Catégorie de tâche:</label>
              <input type="text" class="form-control" name="{{'label_'.$i}}"/>
          </div>
          <div class="form-group">
              <label for="detail">Tâche :</label>
              <textarea class="form-control" name="{{'detail_'.$i}}"></textarea>
          </div>
    @endfor
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </form>



<div>
@endsection