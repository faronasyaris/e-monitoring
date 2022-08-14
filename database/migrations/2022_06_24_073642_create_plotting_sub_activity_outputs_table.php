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
            $table->tinyInteger('month');
            $table->tinyInteger('target');
            $table->tinyInteger('achievment');
            $table->foreignId('plotting_sub_activity_id')->references('id')->on('plotting_sub_activities')->cascadeOnDelete();
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
