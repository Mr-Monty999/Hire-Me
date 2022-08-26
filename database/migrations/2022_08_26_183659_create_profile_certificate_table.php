<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_certificate', function (Blueprint $table) {
            $table->bigInteger("profile_id")->unsigned();
            $table->bigInteger("certificate_id")->unsigned();
            $table->timestamps();

            $table->primary(["profile_id", "certificate_id"]);
            $table->foreign("profile_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("certificate_id")->references("id")->on("certificates")->cascadeOnDelete()->cascadeOnUpdate();
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
