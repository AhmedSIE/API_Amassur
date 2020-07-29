<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssurancesmaisonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurancesmaison', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assurance_id');
            $table->string('statut');
            $table->string('bienconcerne');
            $table->string('nombrepiece');
            $table->string('stockagemarchandise');
            $table->string('bienprecieux');
            $table->string('valeurmobilier');
            $table->string('valeurelectronique');
            $table->string('nombrenfant');
            $table->string('nombrehabitant');
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
        Schema::dropIfExists('assurancesmaison');
    }
}
