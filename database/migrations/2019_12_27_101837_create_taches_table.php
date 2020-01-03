<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('taches');
        Schema::create('taches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('proposition_id')->unsigned();
            $table->foreign('proposition_id')
                    ->references('id')->on('propositions')
                    ->onDelete('cascade');
            $table->string('label');
            $table->mediumText('detail');
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
        Schema::dropIfExists('taches');
    }
}
