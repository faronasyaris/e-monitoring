<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivitySubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activity_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('sub_activity_id')->references('id')->on('sub_activities')->cascadeOnDelete();
            $table->string('submission_file')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('approved_at');
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
        Schema::dropIfExists('sub_activity_submissions');
    }
}
