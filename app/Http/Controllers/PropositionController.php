<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proposition ;
use App\Site ;
use App\Tarif ;
use App\User ;
use App\Tache ;


class PropositionController extends Controller
{

    public function __construct ()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propositions = DB::Table('propositions')
        ->join('users', 'propositions.user_id', '=', 'users.id')
        ->join('tarifs', 'propositions.tarif_id', '=', 'tarifs.id')
        ->join('sites', 'propositions.site_id', '=', 'sites.id')
        ->select('propositions.*', 'users.nom', 'users.prenom', 'users.telephone', 'users.statut', 'users.email', 'sites.site', 'tarifs.label', 'tarifs.tjm')
        ->get();
        foreach ($propositions as $key => $proposition) {
            $proposition->existTache = FALSE;
            if( DB::Table('taches')->where('proposition_id', '=', $proposition->id)->count() > 0 ){
                $propositions[$key]->existTache = TRUE;
            }
        }
        return view('proposition/index', compact('propositions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tarifs = Tarif::all();
        $sites = Site::all();
        $users = User::all();
        return view('proposition/create', compact('tarifs', 'users', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client' => 'required|max:255',
            'entite_client'=> 'required|max:255',
            'interlocuteur'=> 'required|max:255',
            'user_id' => 'required|numeric',
            'tarif_id' => 'required|numeric',
            'site_id' => 'required|numeric',
            'tarif_propose' => 'required|numeric',

            'reference' => 'required|max:255',
            'nom_document' => 'required|max:255',
            'nbre_jours_gratuit' => 'required|numeric',
            'nbre_jours_conge' => 'required|numeric',
            'nbre_tache' => 'nullable|numeric',

            'date_debut' => 'required|date',
            'date_fin' => 'required|date'
        ]);
        $proposition = Proposition::create($validatedData);
   
        return redirect('/proposition')->with('success', 'Proposition is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        //$codesource = file_get_contents('https://www.google.fr/search?q=it+manager+linkedin+paris');
       // echo $codesource;
       //preg_match_all("#<h3 class=\"r\"><a href=\"/url\?q=.+\">(.+)</a></h3>#iU", $codesource, $tableau_resultat);
       // echo "<pre>";
        //print_r($tableau_resultat[1]);
       // echo "</pre>";
       // die;

        $proposition = Proposition::getPropositionById($id);
        $proposition->nbJoursOuvre = nb_jours($proposition->date_debut, $proposition->date_fin);
        $totalGratuit = $totalCp = 0;
        if ($proposition->nbre_jours_gratuit != 0 && !is_null($proposition->nbre_jours_gratuit)){

            $totalGratuit = $proposition->nbre_jours_gratuit * $proposition->tarif_propose;
        }
        if ($proposition->nbre_jours_conge != 0 && !is_null($proposition->nbre_jours_conge)){
            
            $totalCp = $proposition->nbre_jours_conge * $proposition->tarif_propose;
        }

        $proposition->tarifFinal = ($proposition->tarif_propose * $proposition->nbJoursOuvre) - ($totalGratuit + $totalCp);

        $taches = Tache::where('proposition_id', $id) ->get();
        $i = 1;
        foreach ($taches as $key => $tache) {
            $taches[$key]->occurence = $i;
            $i++;
        }
        return view('proposition/view', compact('proposition', 'taches'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addTache($id)
    {
        $proposition = Proposition::getPropositionById($id);
        $proposition->nbJoursOuvre = nb_jours($proposition->date_debut, $proposition->date_fin);
        
        $proposition->tarifFinal = $proposition->tarif_propose * $proposition->nbJoursOuvre;
        return view('proposition/addTache', compact('proposition'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate($id){

        $proposition = Proposition::getPropositionById($id);
        $proposition->nbJoursOuvre = nb_jours($proposition->date_debut, $proposition->date_fin);

        $totalGratuit = $totalCp = 0;
        if ($proposition->nbre_jours_gratuit != 0 && !is_null($proposition->nbre_jours_gratuit)){

            $totalGratuit = $proposition->nbre_jours_gratuit * $proposition->tarif_propose;
        }
        if ($proposition->nbre_jours_conge != 0 && !is_null($proposition->nbre_jours_conge)){
            
            $totalCp = $proposition->nbre_jours_conge * $proposition->tarif_propose;
        }

        $proposition->tarifFinal = ($proposition->tarif_propose * $proposition->nbJoursOuvre) - ($totalGratuit + $totalCp);

        $taches = Tache::where('proposition_id', $id) ->get();
        $i = 1;
        foreach ($taches as $key => $tache) {
            $taches[$key]->occurence = $i;
            $i++;
        }

        $pw = new \PhpOffice\PhpWord\PhpWord();
        
        $html = "<table>
                    <tr>
                        <td>A lattention de la societé:</td>
                        <td style='font-size:30px;font-weight: bold;'>".$proposition->client." </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style='font-size:30px;font-weight: bold;'>".$proposition->interlocuteur." </td>
                    </tr>
                </table>
                <br/><br/><br/><br/>
                <p style='font-size:30px;font-weight: bold;text-align: center'>Proposition Technique et Commerciale</p>
                <p style='font-size:30px;font-weight: bold;text-align: center'>". $proposition->entite_client ." </p>
                <br/><br/><br/><br/>";
                
        $html .="<table style='width:100%;text-align: center'>
                    <tr>

                        <td><p style='font-weight: bold;text-align: center'>Rédaction</p></td>
                        <td><p style='text-align: center'> ".$proposition->nom ." ". $proposition->prenom  ."</p></td>
                        <td><p style='text-align: center'> $proposition->statut  </p></td>
                        <td><p style='text-align: center'> $proposition->email    <br />  $proposition->telephone  </p></td>
                    </tr>
                </table>
                
                <br/><br/><br/> <br/><br/>

                <table style='width:100%;'>
                    <tr>
                        <td style='width:40%;'>
                            <p style='font-weight:bold'>Groupe Astek </p><br /><p>Les Patios, Bâtiment D <br />77-81ter, rue Marcel Dassault <br />92100 Boulogne Billancourt  </p>
                        </td>
                        <td style='width:60%;'>
                            <table style='width:100%;'>
                                <tr>
                                    <td style='width:50%;font-weight:bold'>Référence :</td>
                                    <td style='width:50%;'> $proposition->reference </td>
                                </tr>
                                <tr>
                                    <td><p style='font-weight:bold'>Date :</p></td>
                                    <td> ".date('Y-m-d')." </td>
                                </tr>
                                <tr>
                                    <td><p style='font-weight:bold'>Version :</p></td>
                                    <td>1.1</td>
                                </tr>
                                <tr>
                                    <td><p style='font-weight:bold'>Confidentialité  :</p></td>
                                    <td>CONFIDENTIEL </td>
                                </tr>
                                <tr>
                                    <td><p style='font-weight:bold'>Nombre de pages :</p></td>
                                    <td>X</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table><br/>
                <p style='text-align:center;'>Les informations contenues dans ce document sont strictement confidentielles et ne peuvent être reproduites sans l’accord préalable d’Astek</p>
                ";


        $html .= "<h1 style='font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;'> 1  CONDITIONS DE REALISATION DE LA PRESTATION  </h1>
                    <p>
                        Cette  Proposition  Technique  et Commerciale  d’Astek    est établie  en  réponse  au  document  $proposition->client  intitulé « CdC_S1-2018-expertise technique-v1 0 » 
                        et a pour but de définir les conditions et modalités de l’intervention d’Astek. 
                    </p>
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 1.1  Définition de la prestation </h2>

                    <p>Dans le cadre du projet Parsifal, la prestation réalisée par Astek consiste à : </p>
                    <ul>";

        foreach ($taches as $key => $tache) {
            $html .= "<li><p style='font-family: Calibri;font-size: 20px;color:#8FBC13;'>Tâche $tache->occurence: $tache->label  </p><br />".nl2br($tache->detail)."<br /></li>";
        }

        
      
                    
                    
        $html .= "  </ul>  
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 1.2  Moyens matériels  </h2>

                    <p>ORANGE mettra à disposition de l’équipe Astek en charge du projet les moyens matériels et informatiques nécessaires à son bon déroulement.</p>
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 1.3  Suivi de la prestation  </h2>

                    <p>Afin de s’assurer du bon déroulement de la prestation réalisée par Astek, des réunions de suivi de prjet auront lieu une fois par trimestre en présence du responsable désigné par ORANGE et de l’équipe Astek en charge de cette prestation. 
                    <br />La fréquence pourra être modulée à la demande de l’une ou l’autre des parties. 
                    <br />Un compte rendu de cette réunion sera établi par Astek.
                    </p>


                    <h1 style='font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;'> 2  DATES ET DUREE DE LA PRESTATION   </h1>
                    <p>Les principales dates du calendrier de réalisation de la prestation :</p>
                    <ul>
                        <li>Date de démarrage des travaux : $proposition->date_debut </li>
                        <li>Date de fin des travaux : $proposition->date_fin </li>
                    </ul>
                    <p>La prestation durera $proposition->nbJoursOuvre jours ouvrés.</p>
                    <p>La prestation pourra être prolongée selon les nécessités du projet, et fera l’objet dans ce cas de l’établissement d’un avenant.</p>
                    <p>ORANGE s’engage à informer Astek au minimum 3 semaines avant la fin de la prestation. </p>
                    <p>ORANGE pourra résilier le contrat régissant cette prestation, en respectant un préavis de 1 mois débutant à la réception par Astek d’un courrier recommandé avec accusé de réception notifiant la fin de prestation.</p>
        ";


        $html .="<br />
                    <h1 style='font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;'> 3  LIEU D’EXECUTION   </h1>
                    <p>Du fait de l’utilisation de moyens spécifiques, la prestation sera réalisée dans les locaux de ORANGE situés :</p>
                    <p style='text-align:center;'> $proposition->site </p>
                    <p>Les ressources affectées par Astek devront respecter les règles de sécurité de ORANGE.</p>



                    <h1 style='font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;'> 4  PROPOSITION FINANCIERE    </h1>
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 4.1  Montant de la prestation  </h2>

                    <p>Pour une charge prévisionnelle de $proposition->nbJoursOuvre jours ouvrés, le budget prévisionnel s’élève à $proposition->tarifFinal € HT :</p>
                    <ul>
                        <li><b>TJM contrat cadre $proposition->label : $proposition->tjm € HT </b></li>
                        <li><b>TJM proposé : $proposition->tarif_propose € HT</b></li>";

        if ($proposition->nbre_jours_gratuit != 0 && !is_null($proposition->nbre_jours_gratuit)){

            $html .="   <li><b>Nombre jours gratuit :  $proposition->nbre_jours_gratuit  Jours</b></li>";
        }
        if ($proposition->nbre_jours_conge != 0 && !is_null($proposition->nbre_jours_conge)){

            $html .="<li><b>Nombre de jours conge :  $proposition->nbre_jours_conge  Jours</b></li>";
        }
            $html .="</ul>
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 4.2  Frais de déplacement   </h2>

                    <p>Les coûts de transports vers le site de ORANGE tel que défini §3 page 3 sont pris en charge par Astek.</p>
                    <p>Tous les frais complémentaires engagés à la demande de ORANGE seront facturés par Astek sur présentation des justificatifs</p>
                    <h2 style='font-family: Calibri;font-size: 25px;color:#8FBC13;'> 4.3  Envoi de la commande   </h2>

                    <p>La commande est à adresser à : Astek Boulogne-Billancourt</p>
                    <h1 style='font-family: Calibri;font-size: 30px; background-color:#8FBC13;color:white;'> 5  VALIDITE DE L’OFFRE   </h1>
                    <p>La présente offre est valable 2 semaines à compter de sa date d’envoi.</p>
        
        
        ";

        

        /* [THE HTML] */
        $section = $pw->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

        $pw->save("html-to-doc.docx", "Word2007");

        /* [OR FORCE DOWNLOAD] */
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="convert.docx"');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($pw, 'Word2007');
        $objWriter->save('php://output');




        
    }
}
