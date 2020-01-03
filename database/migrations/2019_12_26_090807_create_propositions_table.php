<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('propositions');
        Schema::create('propositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client');
            $table->string('interlocuteur');
            $table->string('entite_client');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('tarif_propose')->nullable();


            $table->string('reference');
            $table->string('nom_document');
            $table->integer('nbre_jours_gratuit')->nullable();
            $table->integer('nbre_jours_conge')->nullable();
            $table->integer('nbre_tache');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->integer('tarif_id')->unsigned()->nullable();
            $table->foreign('tarif_id')
                    ->references('id')->on('tarifs')
                    ->onDelete('set null');
            $table->integer('site_id')->unsigned()->nullable();
            $table->foreign('site_id')
                    ->references('id')->on('tarifs')
                    ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propositions');
    }
}
