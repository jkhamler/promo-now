<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrantTierItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrant_tier_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrant_id');
            $table->integer('tier_item_id');
            $table->enum('claim_status',
                [
                    'PENDING',
                    'CLAIMED',
                    'REJECTED',
                    'ON_HOLD',
                    'DISPATCHED',
                ]);
            $table->dateTime('claimed_datetime')->nullable();
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
        Schema::dropIfExists('entrant_tier_items');
    }
}
