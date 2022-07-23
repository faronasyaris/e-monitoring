<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_indicators', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('unit');
            $table->double('target')->default(0);
            $table->double('progress')->default(0);
            $table->foreignId('program_id')->references('id')->on('programs')->cascadeOnDelete();
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
        Schema::dropIfExists('program_indicators');
    }
}
