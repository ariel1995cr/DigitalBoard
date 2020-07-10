<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtaskStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtask_state', function (Blueprint $table) {
            $table->unsignedBigInteger('subtask_id');
            $table->foreign('subtask_id')->references('id')->on('subtasks');
            $table->string('state_id');
            $table->foreign('state_id')->references('id')->on('state');
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
        Schema::dropIfExists('subtask_state');
    }
}
