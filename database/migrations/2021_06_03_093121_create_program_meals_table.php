<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramMealsTable extends Migration
{
    /**
     * ÖĞÜNLER, KAHVALTI VS VS GİBİ
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("name");
            $table->integer("program_id")->unsigned();
            $table->integer("order")->unsigned();
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
        Schema::dropIfExists('program_meals');
    }
}
