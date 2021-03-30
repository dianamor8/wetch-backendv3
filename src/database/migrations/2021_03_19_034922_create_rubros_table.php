<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 100);            
            $table->foreignId('TipoRubro_id')->constrained('tipo_rubros')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 250);
            $table->string('unidad', 250);
            $table->double('precioUnitario', 10,2);
            $table->double('pma', 8,2);
            $table->double('pmo', 8,2);
            $table->double('peq', 8,2);
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
        Schema::dropIfExists('rubros');
    }
}
