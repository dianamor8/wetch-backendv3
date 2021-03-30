<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaViviendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('area_viviendas');
        Schema::create('area_viviendas', function (Blueprint $table) {
            $table->id();
            $table->double('area', 8, 2);
            $table->string('unidadMedida', 100);
            $table->foreignId('TipoAreaVivienda_id')->constrained('tipo_area_viviendas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Ambiente_id')->constrained('ambientes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('area_viviendas');
    }
}
