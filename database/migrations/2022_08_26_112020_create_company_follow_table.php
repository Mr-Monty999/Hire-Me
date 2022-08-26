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
            $table->bigInteger("profile_id")->unsigned();
            $table->timestamps();

            $table->primary(["company_id", "profile_id"]);
            $table->foreign("company_id")->references("id")->on("companies")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("profile_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
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
