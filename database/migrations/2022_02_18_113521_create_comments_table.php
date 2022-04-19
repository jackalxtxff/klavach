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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dictionary_id');
            $table->text('comment');
            $table->timestamps();

            $table->index('user_id', 'comment_user_idx');
            $table->foreign('user_id', 'comment_user_fk')->on('users')->references('id')->onDelete('cascade');

            $table->index('dictionary_id', 'comment_dictionary_idx');
            $table->foreign('dictionary_id', 'comment_dictionary_fk')->on('dictionaries')->references('id')->onDelete('cascade');
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
