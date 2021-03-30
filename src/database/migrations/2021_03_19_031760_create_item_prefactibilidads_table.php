<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPrefactibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_prefactibilidads', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->double('subtotal', 8, 2);
            $table->foreignId('Ambiente_id')->constrained('ambientes');
            $table->foreignId('Prefactbilidad_id')->constrained('prefactibilidads')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('item_prefactibilidads');
    }
}
