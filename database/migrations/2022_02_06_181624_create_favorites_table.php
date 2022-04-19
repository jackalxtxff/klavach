<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dictionary_id');
            $table->timestamps();
            $table->unique(['user_id', 'dictionary_id'], 'user_id_dictionary_id_unique');

            $table->index('user_id', 'favorite_user_idx');
            $table->foreign('user_id', 'favorite_user_fk')->on('users')->references('id')->onDelete('cascade');

            $table->index('dictionary_id', 'favorite_dictionary_idx');
            $table->foreign('dictionary_id', 'favorite_dictionary_fk')->on('dictionaries')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
