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
            $table->string('sub_activity_name');
            $table->foreignId('year')->references('id')->on('periodes')->cascadeOnDelete();
            $table->foreignId('field_id')->nullable();
            $table->foreign('field_id')->references('id')->on('fields')->nullOnDelete();
            $table->foreignId('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->foreignId('created_id')->nullable();
            $table->foreign('created_id')->references('id')->on('users')->nullOnDelete();
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
