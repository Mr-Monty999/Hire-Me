<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_like', function (Blueprint $table) {
            $table->bigInteger("comment_id")->unsigned();
            $table->bigInteger("profile_id")->unsigned();
            $table->timestamps();

            $table->primary(["profile_id", "comment_id"]);
            $table->foreign("comment_id")->references("id")->on("comments")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('comment_like');
    }
}
