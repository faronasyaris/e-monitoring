<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlottingSubActivityOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plotting_sub_activity_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->integer('target');
            $table->integer('achievment')->default(0);
            $table->tinyInteger('month');
            $table->foreignId('outcome_id')->references('id')->on('sub_activity_outputs')->cascadeOnDelete();
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
        Schema::dropIfExists('plotting_sub_activity_outputs');
    }
}
