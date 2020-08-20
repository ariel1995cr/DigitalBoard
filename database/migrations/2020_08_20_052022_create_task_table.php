<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->string('taskName', 100);
            $table->string('locationName', 100);
            // $table->string('longitud', 100);
            $table->primary(['locationName', 'taskName']);

            $table->foreign('locationName')->references('name')->on('location');
            

            $table->date('taskStart');
            $table->date('taskEnd');
            $table->string('taskDescription', 100);

            
            $table->bigInteger('createdBy')->unsigned();
            $table->foreign('createdBy')->references('id')->on('users');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
