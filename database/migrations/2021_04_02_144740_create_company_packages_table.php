<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("company_id")->unsigned();
            $table->integer("package_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("companies");
            $table->foreign("package_id")->references("id")->on("packages");
            $table->integer("status")->default(1);
            $table->timestamp("start_date")->default(now());
            $table->timestamp("end_date")->nullable(); // aylık ise 1 ay sonrasına, yıllık ise 1 yıl sonrasına yapılacak.
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
        Schema::dropIfExists('company_packages');
    }
}
