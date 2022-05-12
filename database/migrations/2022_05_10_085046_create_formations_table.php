<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nom");
            $table->date("dd");
            $table->date("df");
            $table->string("numMarche")->nullable();
            $table->string("numConvention")->nullable();
            $table->unsignedBigInteger("centre_id")->index();
            $table->foreign('centre_id')->references('id')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
