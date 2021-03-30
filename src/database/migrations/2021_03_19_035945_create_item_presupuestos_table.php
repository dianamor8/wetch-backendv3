<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_presupuestos', function (Blueprint $table) {
            $table->id();            
            $table->integer('cantidad');            
            $table->foreignId('Rubro_id')->constrained('rubros');            
            $table->foreignId('Presupuesto_id')->constrained('presupuestos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('item_presupuestos');
    }
}
