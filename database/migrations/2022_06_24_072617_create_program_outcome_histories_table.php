<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramOutcomeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_outcome_histories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('outcome_id')->references('id')->on('program_outcomes');
            $table->foreignId('program_id')->references('id')->on('programs');
            $table->integer('achievment');
            $table->string('file')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
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
        Schema::dropIfExists('program_outcome_histories');
    }
}
