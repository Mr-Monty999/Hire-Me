<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); //follow ,comments etc
            $table->string('data'); //follow id ,comment id etc ,you can set relationship in model about this
            $table->bigInteger('profile_id')->unsigned(); // set relationship in profile model
            $table->bigInteger('profile_to_notify')->unsigned(); //the profile who will recive this notification
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
        Schema::dropIfExists('notifications');
    }
}
