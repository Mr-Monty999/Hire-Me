<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_follow', function (Blueprint $table) {
            $table->bigInteger("company_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();

            $table->primary(["company_id", "user_id"]);
            $table->foreign("company_id")->references("id")->on("companies")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_follow');
    }
}
