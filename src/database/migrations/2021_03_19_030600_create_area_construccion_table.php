<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaConstruccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_construccions', function (Blueprint $table) {
            $table->id();
            $table->string('callePrincipal', 250);
            $table->string('calleSecundaria', 250);
            $table->double('retiroFrontal', 6, 2);
            $table->double('retiroPosterior', 6, 2);
            $table->double('retiroLateralIzquierdo', 6, 2);
            $table->double('retiroLateralDerecho', 6, 2);
            $table->double('medidaFrente', 10, 2);
            $table->double('medidaFondo', 10, 2);
            $table->double('areaTotal', 20, 2)->default(-1);
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
        Schema::dropIfExists('area_construccions');
    }
}
