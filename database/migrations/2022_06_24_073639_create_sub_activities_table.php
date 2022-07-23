<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit_target');
            $table->foreignId('activity_id')->references('id')->on('sub_activities')->cascadeOnDelete();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('finished_at');
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
        Schema::dropIfExists('sub_activities');
    }
}
