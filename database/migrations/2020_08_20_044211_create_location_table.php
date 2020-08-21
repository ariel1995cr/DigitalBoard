<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->string('name');
            $table->string('latitud', 100);
            $table->string('longitud', 100);	
            $table->string('direction', 100)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->primary(['name', 'latitud', 'longitud']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
}
