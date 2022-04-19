<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dictionary_id');
            $table->float('avg_grade')->nullable()->default(0);
            $table->integer('count_games')->nullable()->default(0);
            $table->float('avg_speed')->nullable()->default(0);
            $table->float('count_mistakes')->nullable()->default(0);
            $table->float('percent_mistakes')->nullable()->default(0);
            $table->timestamps();

            $table->index('dictionary_id', 'stats_dictionary_idx');
            $table->foreign('dictionary_id', 'stats_dictionary_fk')->on('dictionaries')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
