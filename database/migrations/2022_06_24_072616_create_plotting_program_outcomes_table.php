<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlottingProgramOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plotting_program_outcomes', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->integer('target');
            $table->integer('achievment')->default(0);
            $table->tinyInteger('month');
            $table->foreignId('outcome_id')->references('id')->on('program_outcomes')->cascadeOnDelete();
            // $table->foreignId('plotting_program_id')->references('id')->on('plotting_programs')->cascadeOnDelete();
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
        Schema::dropIfExists('plotting_program_outcomes');
    }
}
