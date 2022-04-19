<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcerptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excerpts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dictionary_id');
            $table->text('excerpt');
            $table->timestamps();

            $table->index('dictionary_id', 'excerpt_dictionary_idx');
            $table->foreign('dictionary_id', 'excerpt_dictionary_fk')->on('dictionaries')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excerpts');
    }
}
