<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_react', function (Blueprint $table) {
            $table->bigInteger("post_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->integer("type")->unsigned();
            $table->timestamps();

            $table->primary(["post_id", "user_id"]);
            $table->foreign("post_id")->references("id")->on("posts")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('post_react');
    }
}
