<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefactibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefactibilidads', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');            
            $table->foreignId('User_id')->constrained('users');
            $table->string('typeArea', 10);
            $table->foreignId('AreaConstruccion_id')->constrained('area_construccions')->onUpdate('cascade')->onDelete('cascade');            
            $table->foreignId('Acabado_id')->constrained('tipo_acabados');
            $table->foreignId('proyecto_id')->constrained('proyectos');
            $table->double('subtotalAreaConstruccion', 12, 2);
            $table->double('areaCirculacionParedes', 12, 2);
            $table->double('areaTotalConstruccion', 12, 2);
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
        //Schema::dropIfExists('prefactibilidads');        
    }
}
