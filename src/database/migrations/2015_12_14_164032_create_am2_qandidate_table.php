<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAm2QandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('am2_qandidate_toggles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->string('strategy');
            $table->timestamps();
        });
        Schema::create('am2_qandidate_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('toggle_id')->unsigned();
            $table->string('name');
            $table->string('key');
            $table->string('operator');
            $table->string('value');
            $table->timestamps();

                $table->foreign('toggle_id')->references('id')->on('am2_qandidate_toggles')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('am2_qandidate_conditions');
        Schema::dropIfExists('am2_qandidate_toggles');
    }
}
