<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class proposition extends Model
{
    protected $fillable = [ 'id', 
                            'reference', 
                            'nom_document', 
                            'client', 
                            'entite_client', 
                            'interlocuteur', 
                            'user_id', 
                            'tarif_id', 
                            'site_id', 
                            'tarif_propose', 
                            'nbre_jours_gratuit',
                            'nbre_jours_conge',
                            'nbre_tache',
                            'date_debut', 
                            'date_fin'];

    public static function getPropositionById($id){

        $proposition = DB::Table('propositions')
                        ->join('users', 'propositions.user_id', '=', 'users.id')
                        ->join('tarifs', 'propositions.tarif_id', '=', 'tarifs.id')
                        ->join('sites', 'propositions.site_id', '=', 'sites.id')
                        ->select('propositions.*', 'users.nom', 'users.prenom', 'users.telephone', 'users.statut', 'users.email', 'sites.site', 'tarifs.label', 'tarifs.tjm')
                        ->where('propositions.id', '=', $id)
                        ->first();
        return $proposition;
    }
}

