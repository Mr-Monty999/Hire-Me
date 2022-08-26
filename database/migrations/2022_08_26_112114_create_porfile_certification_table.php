<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateprofileCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_certification', function (Blueprint $table) {
            $table->bigInteger("profile_id")->unsigned();
            $table->bigInteger("certification_id")->unsigned();
            $table->timestamps();

            $table->primary(["profile_id", "certification_id"]);
            $table->foreign("profile_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("certification_id")->references("id")->on("certificates")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_certificate');
    }
}
