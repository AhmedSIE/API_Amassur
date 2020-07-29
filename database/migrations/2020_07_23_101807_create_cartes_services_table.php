<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartesServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartes_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carte_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('carte_id')
                ->references('id')
                ->on('cartes');
            $table->foreign('service_id')
                ->references('id')
                ->on('services');

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
        Schema::dropIfExists('cartes_services');
    }
}
