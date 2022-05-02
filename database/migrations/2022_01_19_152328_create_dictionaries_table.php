<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_publish');
            $table->boolean('is_systemic')->default(0);
            $table->string('title', 70);
            $table->string('description', 300);
            $table->string('information', 1000);
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'dictionary_user_idx');
            $table->foreign('user_id', 'dictionary_user_fk')->on('users')->references('id')->onDelete('set null');

            $table->index('type_id', 'dictionary_type_idx');
            $table->foreign('type_id', 'dictionary_type_fk')->on('types')->references('id')->onDelete('set null');

            $table->index('language_id', 'dictionary_language_idx');
            $table->foreign('language_id', 'dictionary_language_fk')->on('languages')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionaries');
    }
}
