<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivityWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activity_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_activity_id')->nullable();
            $table->foreignId('worker_id')->nullable();
            $table->string('submission_file')->nullable();
            $table->foreign('sub_activity_id')->references('id')->on('sub_activities')->nullOnDelete();
            $table->foreign('worker_id')->references('id')->on('users')->nullOnDelete();
            $table->year('year');
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
        Schema::dropIfExists('sub_activity_workers');
    }
}
