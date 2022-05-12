<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriteresFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('critere_formation', function (Blueprint $table) {
            $table->foreignId('formation_id')->constrained();
            $table->foreignId('critere_id')->constrained();
            $table->integer('valeur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criteresformations');
    }
}
