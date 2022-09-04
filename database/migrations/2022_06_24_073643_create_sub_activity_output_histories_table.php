<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivityOutputHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activity_output_histories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('sub_activity_id')->references('id')->on('sub_activities');
            $table->foreignId('outcome_id')->references('id')->on('sub_activity_outputs')->cascadeOnDelete();
            $table->double('achievment');
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
        Schema::dropIfExists('sub_activity_output_histories');
    }
}
