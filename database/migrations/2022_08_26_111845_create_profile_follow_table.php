<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_follow', function (Blueprint $table) {
            $table->bigInteger("profile_id")->unsigned();
            $table->bigInteger("profile_followed_id")->unsigned();
            $table->timestamps();

            $table->primary(["profile_id", "profile_followed_id"]);

            $table->foreign("profile_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("profile_followed_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_follow');
    }
}
