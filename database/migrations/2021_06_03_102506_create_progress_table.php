<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->double('shoulder');
            $table->double('chest');
            $table->double('waist');
            $table->double('hips');
            $table->double('tighs');
            $table->double('calf');
            $table->double('weight');
            $table->string('notes', 500);
            $table->integer('program_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
