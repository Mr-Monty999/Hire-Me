<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_react', function (Blueprint $table) {
            $table->bigInteger("comment_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->integer("type")->unsigned();

            $table->timestamps();

            $table->primary(["user_id", "comment_id"]);
            $table->foreign("comment_id")->references("id")->on("comments")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('comment_react');
    }
}
