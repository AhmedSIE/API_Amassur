<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssurancesmotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurancesmoto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assurance_id');
            $table->string('modestationnement');
            $table->string('modele');
            $table->string('marque');
            $table->string('immatriculation');
            $table->longText('photoimmatriculation');
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
        Schema::dropIfExists('assurancesmoto');
    }
}
