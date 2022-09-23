<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text("content");
            $table->string("photo", 255)->nullable();
            $table->bigInteger("post_id")->unsigned();
            $table->bigInteger("profile_id")->unsigned();
            $table->bigInteger("comment_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("post_id")->references("id")->on("posts")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("profile_id")->references("id")->on("profiles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("comment_id")->references("id")->on("comments")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
