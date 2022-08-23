<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlottingSubActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plotting_sub_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_activity_id')->references('id')->on('sub_activities')->cascadeOnDelete();
            $table->tinyInteger('month');
            $table->integer('budget');
            $table->integer('finance_realization')->default(0);
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            // $table->tinyInteger('is_exists');
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
        Schema::dropIfExists('plotting_sub_activities');
    }
}
