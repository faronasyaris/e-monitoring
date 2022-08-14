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
            $table->tinyInteger('month');
            $table->tinyInteger('target');
            $table->tinyInteger('achievment');
            $table->foreignId('plotting_program_id')->references('id')->on('plotting_programs')->cascadeOnDelete();
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
