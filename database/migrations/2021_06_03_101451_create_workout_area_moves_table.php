<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutAreaMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_area_moves', function (Blueprint $table) {
            $table->id();
            $table->integer("workout_area_id")->unsigned();
            $table->integer("move_id")->unsigned();
            $table->integer('sets')->unsigned();
            $table->integer('reps')->unsigned();
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
        Schema::dropIfExists('workout_area_moves');
    }
}
