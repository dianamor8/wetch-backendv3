<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAreaViviendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_area_viviendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->double('factorCirculacionParedes', 6, 2);
            $table->double('factorDireccionTecnica', 6, 2);
            $table->foreignId('propietario')->constrained('users');
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
        Schema::dropIfExists('tipo_area_viviendas');
    }
}
