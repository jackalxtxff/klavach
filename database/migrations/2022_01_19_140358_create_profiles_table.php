<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('about')->nullable();
            $table->string('photo')->nullable();
            $table->string('local_photo')->nullable();
            $table->float('record_speed')->nullable()->default(0);
            $table->float('avg_speed')->nullable()->default(0);
            $table->float('avg_mistakes')->nullable()->default(0);
            $table->integer('count_games')->nullable()->default(0);
            $table->timestamps();

            $table->index('user_id', 'profile_user_idx');
            $table->foreign('user_id', 'profile_user_fk')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
