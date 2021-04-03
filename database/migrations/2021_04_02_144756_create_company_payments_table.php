<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("company_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("companies");
            $table->float("payment");
            $table->integer("status")->default(1);
            $table->timestamp("payment_date")->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_payments');
    }
}
