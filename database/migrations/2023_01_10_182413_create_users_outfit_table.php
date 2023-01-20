<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersOutfitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_outfit', function (Blueprint $table) {
            //$table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('outfit_id');
            $table->primary(['user_id', 'outfit_id']);
            $table->boolean('liked');
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
            $table->foreign('outfit_id')->references('id')->on('outfits') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_outfit');
    }
}
