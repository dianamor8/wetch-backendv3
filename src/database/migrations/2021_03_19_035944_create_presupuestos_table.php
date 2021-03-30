<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();            
            $table->date('fecha');            
            $table->foreignId('User_id')->constrained('users');            
            $table->foreignId('CostoIndirecto_id')->constrained('costo_indirectos')->nullable($value = true);
            $table->double('subtotal', 12, 2);
            $table->double('totalCostosDirectos', 12, 2);
            $table->double('totalCostosIndirectos', 12, 2);
            $table->foreignId('proyecto_id')->constrained('proyectos');                  
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
        Schema::dropIfExists('presupuestos');
    }
}
