<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            #$table->string('ubicacion_id');
            #$table->foreign('ubicacion_id')->references('id')->on('ubications');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('direccion')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
