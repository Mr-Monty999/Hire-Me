<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_phones', function (Blueprint $table) {
            $table->id();
            $table->string("phone", 255);
            $table->bigInteger("company_id")->unsigned();
            $table->timestamps();

            $table->foreign("company_id")->references("id")->on("companies")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_phones');
    }
}
