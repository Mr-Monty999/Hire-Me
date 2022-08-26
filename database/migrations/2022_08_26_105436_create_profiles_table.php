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
            $table->string("firstname",255);
            $table->string("lastname",255);
            $table->string("nickname",255);
            $table->text("about");
            $table->string("avatar",255);
            $table->string("background_photo",255);
            $table->string("website",255);
            $table->string("country",255);
            $table->string("city",255);
            $table->string("state",255);
            $table->string("street",255);
            $table->string("university",255);
            $table->string("degree",255);
            $table->string("study_type",255);
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
        Schema::dropIfExists('profiles');
    }
}
