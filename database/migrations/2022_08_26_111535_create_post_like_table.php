<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_like', function (Blueprint $table) {
            $table->bigInteger("post_id")->unsigned();
            $table->bigInteger("profile_id")->unsigned();
            $table->timestamps();

            $table->primary(["post_id", "profile_id"]);
            $table->foreign("post_id")->references("id")->on("posts")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('post_like');
    }
}
