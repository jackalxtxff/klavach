<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dictionary_id');
            $table->float('avg_speed');
            $table->float('count_mistakes');
            $table->float('percent_mistakes');
            $table->timestamps();

            $table->index('user_id', 'game_user_idx');
            $table->foreign('user_id', 'game_user_fk')->on('users')->references('id')->onDelete('cascade');

            $table->index('dictionary_id', 'game_dictionary_idx');
            $table->foreign('dictionary_id', 'game_dictionary_fk')->on('dictionaries')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
