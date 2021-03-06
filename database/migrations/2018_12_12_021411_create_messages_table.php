<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('content')->nullable();
            $table->boolean('is_file')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('messages', function(Blueprint $table){
            $table->foreign('channel_id')->references('id')->on('channels');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
