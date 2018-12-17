<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mechanics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', [
                'WINNING_MOMENT',
                'TIMED_DRAW',
                'EVERYBODY_GETS',
                'ITEM_PRIZE_SEEDING',
            ]);
            $table->integer('promotion_id');
            $table->dateTime('start_datetime')->nullable();
            $table->dateTime('end_datetime')->nullable();
            $table->boolean('is_open')->default(false);
            $table->boolean('is_recyclable')->default(false);
            $table->integer('claim_window_duration_seconds')->nullable();
            $table->dateTime('claim_window_deadline')->nullable();
            $table->dateTime('draw_datetime')->nullable();
            $table->dateTime('draw_entrants_deadline')->nullable();
            $table->boolean('pi_to_generate_moments')->default(false);
            $table->integer('moment_duration_seconds')->nullable();
            $table->integer('moment_distribution_interval_seconds')->nullable();
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
        Schema::dropIfExists('mechanics');
    }
}
