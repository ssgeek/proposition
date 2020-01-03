@extends('layout')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editer une proposition
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
      <form method="post" action="{{ route('proposition.store') }}">

          <div class="form-group">
              <label for="user_id">Utilisateur :</label>
              <select class="custom-select" name="user_id">
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->nom}}  {{$user->prenom}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              @csrf
              <label for="name">Client:</label>
              <input type="text" class="form-control" name="client"/>
          </div>
          <div class="form-group">
              <label for="price">Référence :</label>
              <input type="text" class="form-control" name="reference"/>
          </div>
          <div class="form-group">
              <label for="price">Nom de document lié l'offre :</label>
              <input type="text" class="form-control" name="nom_document"/>
          </div>
          <div class="form-group">
              <label for="price">Interlocuteur :</label>
              <input type="text" class="form-control" name="interlocuteur"/>
          </div>
          <div class="form-group">
              <label for="quantity">Entité client :</label>
              <input type="text" class="form-control" name="entite_client"/>
          </div>

          <div class="form-group">
              <label for="site_id">Site :</label>
              <select class="custom-select" name="site_id">
                @foreach($sites as $site)
                <option value="{{$site->id}}">{{$site->departement}} - {{$site->site}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="tarif_id">Tarif :</label>
              <select class="custom-select" name="tarif_id">
                @foreach($tarifs as $tarif)
                <option value="{{$tarif->id}}">{{$tarif->label}} / ( TJM {{$tarif->tjm}} € )</option>
                @endforeach  
              </select>
          </div>
          <div class="form-group">
              <label for="tarif_propose">Tarif proposé :</label>
              <input type="text" class="form-control" name="tarif_propose"/>
          </div>
          <div class="form-group">
              <label for="nbre_jours_gratuit">Nombre Jours de gratuité :</label>
              <input type="text" class="form-control" name="nbre_jours_gratuit"/>
          </div>
          <div class="form-group">
              <label for="nbre_jours_conge">Nombre Jours de congé :</label>
              <input type="text" class="form-control" name="nbre_jours_conge"/>
          </div>


          <div class="form-group">
              <label for="date_debut">Date de début :</label>
              <input type="text" class="form-control" name="date_debut" id="prop_date_debut_id"/>
          </div>
          <div class="form-group">
              <label for="date-fin">Date de fin :</label>
              <input type="text" class="form-control" name="date_fin" id="prop_date_fin_id"/>
          </div>
          <div class="form-group">
              <label for="date-fin">Nombre de tâche :</label>
              <input type="text" class="form-control" name="nbre_tache"/>
          </div>


          


          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </form>
  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript">

 //$(document).ready(function() {
  jQuery(document).ready(function ($) {


  if(typeof jQuery!=='undefined'){
    console.log('jQuery Loaded');
  }
  else{
      console.log('not loaded yet');
  } 

    $("#prop_date_debut_id" ).datepicker({
      dateFormat: "yy-mm-dd",
      weekStart: 0,
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
      rtl: true,
      orientation: "auto"
    });
    $("#prop_date_fin_id" ).datepicker({
      dateFormat: "yy-mm-dd",
      weekStart: 0,
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
      rtl: true,
      orientation: "auto"
    });
 });


</script>
