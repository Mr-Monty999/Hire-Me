<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_management', function (Blueprint $table) {
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("company_id")->unsigned();
            $table->string("position", 255);
            $table->timestamps();

            $table->primary(["user_id", "company_id"]);

            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('company_management');
    }
}
