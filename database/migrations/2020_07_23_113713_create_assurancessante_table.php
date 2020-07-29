<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssurancessanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurancessante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assurance_id');
            $table->string('assureprincipal');
            $table->string('sex');
            $table->string('nom');
            $table->string('prenoms');
            $table->string('date_naissance');
            $table->string('regime_obligatoire');
            $table->string('date_debut_contrat');
            $table->string('code_postal')->nullable();
            $table->string('email');
            $table->string('telephone');
            $table->string('conjoint_sex');
            $table->string('conjoint_date_naissance');
            $table->string('conjoint_regime_obligatoire');
            $table->string('nombre_enfants');
            $table->foreign('assurance_id')
                ->references('id')
                ->on('assurances');
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
        Schema::dropIfExists('assurancessante');
    }
}
