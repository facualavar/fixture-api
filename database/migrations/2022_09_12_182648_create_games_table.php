<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('team_1_id', 10)->nullable();
            $table->string('team_2_id', 10)->nullable();
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('matchday_id')->nullable();
            $table->dateTime('date')->nullable();

            $table->foreign('team_1_id')->references('id')->on('teams');
            $table->foreign('team_2_id')->references('id')->on('teams');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('matchday_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
