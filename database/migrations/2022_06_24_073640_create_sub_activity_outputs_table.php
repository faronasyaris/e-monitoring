<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivityOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activity_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->string('activity_output_name');
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
        Schema::dropIfExists('sub_activity_outputs');
    }
}
