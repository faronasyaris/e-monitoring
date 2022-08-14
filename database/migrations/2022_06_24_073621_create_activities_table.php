<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->foreignId('year')->references('id')->on('periodes')->cascadeOnDelete();
            $table->foreignId('field_id')->nullable();
            $table->foreign('field_id')->references('id')->on('fields')->nullOnDelete();
            $table->foreignId('program_id')->references('id')->on('programs')->cascadeOnDelete();
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
        Schema::dropIfExists('activities');
    }
}
