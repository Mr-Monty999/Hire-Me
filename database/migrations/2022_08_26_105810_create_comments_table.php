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
            $table->text("content")->nullable();
            $table->string("photo", 255)->nullable();
            $table->bigInteger("post_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("parent_comment_id")->unsigned()->nullable();
            $table->bigInteger("mention_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("post_id")->references("id")->on("posts")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("parent_comment_id")->references("id")->on("comments")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("mention_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
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
