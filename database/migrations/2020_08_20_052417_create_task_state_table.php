<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_state', function (Blueprint $table) {
            $table->string('taskName', 100);
            $table->string('stateName', 100);
            $table->date('taskStartState');
            $table->date('taskEndState');

            $table->primary(['taskName', 'stateName']);
            $table->foreign('taskName')->references('taskName')->on('task');
            $table->foreign('stateName')->references('stateName')->on('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_state');
    }
}
