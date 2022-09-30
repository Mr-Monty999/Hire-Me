<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_connection', function (Blueprint $table) {
            $table->bigInteger("profile1_id")->unsigned();
            $table->bigInteger("profile2_id")->unsigned();
            $table->boolean("accepted");
            $table->timestamps();

            $table->primary(["profile1_id", "profile2_id"]);


            $table->foreign("profile1_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("profile2_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_connection');
    }
}
