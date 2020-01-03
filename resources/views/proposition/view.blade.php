@extends('orange')
@section('content')
<style>
  .titre_level_2{
    font-family: Calibri;
    font-size: 25px;
    color:#8FBC13;
  },
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

  <table>
    <tr>
      <td><p>A l'attention de la societé:</p></td>
      <td><h1><b>{{$proposition->client}}<br /> {{$proposition->interlocuteur}}</b></h1></td>
    </tr>
  </table>
  <br/><br/>
  
  


  <hr style="border-top: 2px solid #8FBC13;">
  <br/>
  <h1><center>Proposition Technique et Commerciale</center></h1>
  <h1><center>{{ $proposition->entite_client }}</center></h1>
  <br/><br/><br/>


  <hr style="border-top: 2px solid #8FBC13;">
  <center>

      <table style="width:100%;">
          <tr>

            <td><b>Rédaction</b></td>
            <td>{{ $proposition->nom }}{{ $proposition->prenom }}</td>
            <td>{{ $proposition->statut }}</td>
            <td>{{ $proposition->email }}  <br /> {{ $proposition->telephone }}</td>
          </tr>
        </table>

  </center>
  <hr style="border-top: 2px solid #8FBC13;">
  <br/><br/><br/> <br/><br/><br/>

  <table style="width:100%;">
    <tr>
      <td style="width:40%;"><p><b>Groupe Astek </b><br />Les Patios, Bâtiment D <br />77-81ter, rue Marcel Dassault <br />92100 Boulogne Billancourt  </p></td>
      <td style="width:60%;">
        <table style="width:100%;">
          <tr>
            <td style="width:50%;"><b>Référence :</b></td>
            <td style="width:50%;">{{$proposition->reference}}</td>
          </tr>
          <tr>
            <td><b>Date :</b></td>
            <td>2020-02-21</td>
          </tr>
          <tr>
            <td><b>Version :</b></td>
            <td>1.1</td>
          </tr>
          <tr>
            <td><b>Confidentialité  :</b></td>
            <td>CONFIDENTIEL </td>
          </tr>
          <tr>
            <td><b>Nombre de pages :</b></td>
            <td>X</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <br/><br/>

  <p>  <center>Les informations contenues dans ce document sont strictement confidentielles et ne peuvent être reproduites sans l’accord préalable d’Astek  </center></p>






  <h1 style="font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;"> 1  CONDITIONS DE REALISATION DE LA PRESTATION  </h1>
  <p>
    Cette  Proposition  Technique  et Commerciale  d’Astek    est établie  en  réponse  au  document  {{$proposition->client}} intitulé « {{$proposition->nom_document}} » 
    et a pour but de définir les conditions et modalités de l’intervention d’Astek. 
  </p>
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 1.1  Définition de la prestation </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>Dans le cadre du projet Parsifal, la prestation réalisée par Astek consiste à : </p>
  <ul>
    @foreach($taches as $tache)
    <li><p style="font-family: Calibri;font-size: 20px;color:#8FBC13;">Tâche {{$tache->occurence}}: {{$tache->label}}  </p>
        {!! nl2br($tache->detail) !!}
        <br /><br />
    </li>
    @endforeach 
  </ul>  
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 1.2  Moyens matériels  </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>ORANGE mettra à disposition de l’équipe Astek en charge du projet les moyens matériels et informatiques nécessaires à son bon déroulement.</p>
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 1.3  Suivi de la prestation  </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>Afin de s’assurer du bon déroulement de la prestation réalisée par Astek, des réunions de suivi de prjet auront lieu une fois par trimestre en présence du responsable désigné par ORANGE et de l’équipe Astek en charge de cette prestation. 
  <br />La fréquence pourra être modulée à la demande de l’une ou l’autre des parties. 
  <br />Un compte rendu de cette réunion sera établi par Astek.
  </p>






  <h1 style="font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;"> 2  DATES ET DUREE DE LA PRESTATION   </h1>
  <p>Les principales dates du calendrier de réalisation de la prestation :</p>
  <ul>
    <li>Date de démarrage des travaux : {{$proposition->date_debut}}</li>
    <li>Date de fin des travaux : {{$proposition->date_fin}}</li>
  </ul>
  <p>La prestation durera {{ $proposition->nbJoursOuvre }} jours ouvrés.</p>
  <p>La prestation pourra être prolongée selon les nécessités du projet, et fera l’objet dans ce cas de l’établissement d’un avenant.</p>
  <p>ORANGE s’engage à informer Astek au minimum 3 semaines avant la fin de la prestation. </p>
  <p>ORANGE pourra résilier le contrat régissant cette prestation, en respectant un préavis de 1 mois débutant à la réception par Astek d’un courrier recommandé avec accusé de réception notifiant la fin de prestation.</p>



  <h1 style="font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;"> 3  LIEU D’EXECUTION   </h1>
  <p>Du fait de l’utilisation de moyens spécifiques, la prestation sera réalisée dans les locaux de ORANGE situés :</p>
  <center>{{$proposition->site}}</center>
  <p>Les ressources affectées par Astek devront respecter les règles de sécurité de ORANGE.</p>





  <h1 style="font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;"> 4  PROPOSITION FINANCIERE    </h1>
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 4.1  Montant de la prestation  </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>Pour une charge prévisionnelle de {{ $proposition->nbJoursOuvre }} jours ouvrés, le budget prévisionnel s’élève à {{ $proposition->tarifFinal }} HT :</p>
  <ul>
    <li><b>TJM contrat cadre {{ $proposition->label }} (DI051536): {{ $proposition->tjm }} € HT </b></li>
    <li><b>TJM proposé : {{ $proposition->tarif_propose }} € HT</b></li>
    @if ($proposition->nbre_jours_gratuit != 0 && !is_null($proposition->nbre_jours_gratuit))
      <li><b>Nombre jours gratuit : {{ $proposition->nbre_jours_gratuit }} Jours</b></li>
    @endif
    @if ($proposition->nbre_jours_conge != 0 && !is_null($proposition->nbre_jours_conge))
      <li><b>Nombre de jours conge : {{ $proposition->nbre_jours_conge }} Jours</b></li>
    @endif
  </ul>
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 4.2  Frais de déplacement   </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>Les coûts de transports vers le site de ORANGE tel que défini §3 page 3 sont pris en charge par Astek.</p>
  <p>Tous les frais complémentaires engagés à la demande de ORANGE seront facturés par Astek sur présentation des justificatifs</p>
  <h2 style="font-family: Calibri;font-size: 25px;color:#8FBC13;"> 4.3  Envoi de la commande   </h2>
  <hr style="border-top: 2px solid #8FBC13;">
  <p>La commande est à adresser à : Astek Boulogne-Billancourt</p>
  <h1 style="font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;"> 5  VALIDITE DE L’OFFRE   </h1>
  <p>La présente offre est valable 2 semaines à compter de sa date d’envoi.</p>
</div>




<br/><br/> <br/><br/>



<center><a href="{{ route('proposition.generate', $proposition->id)}}"><button class="btn btn-primary">Générer le fichier .docx</button></a></center>
<br/> <br/><br/>

@endsection