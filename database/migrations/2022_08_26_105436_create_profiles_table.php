<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("firstname", 255);
            $table->string("lastname", 255);
            $table->string("nickname", 255)->nullable();
            $table->string("gender", 50);
            $table->date("birthdate")->nullable();
            $table->text("about")->nullable();
            $table->string("avatar", 255)->nullable();
            $table->string("background_photo", 255)->nullable();
            $table->string("website", 255)->nullable();
            $table->string("country", 255)->nullable();
            $table->string("city", 255)->nullable();
            $table->string("state", 255)->nullable();
            $table->string("street", 255)->nullable();
            $table->string("university", 255)->nullable();
            $table->string("degree", 255)->nullable();
            $table->string("study_type", 255)->nullable();
            $table->bigInteger("user_id")->unsigned()->unique();
            $table->timestamps();

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
        Schema::dropIfExists('profiles');
    }
}
