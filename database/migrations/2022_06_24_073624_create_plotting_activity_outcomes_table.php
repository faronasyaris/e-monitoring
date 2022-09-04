<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlottingActivityOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plotting_activity_outcomes', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->double('target');
            $table->double('achievment')->default(0);
            $table->tinyInteger('month');
            $table->foreignId('outcome_id')->references('id')->on('activity_outcomes')->cascadeOnDelete();
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
        Schema::dropIfExists('plotting_activity_outcomes');
    }
}
