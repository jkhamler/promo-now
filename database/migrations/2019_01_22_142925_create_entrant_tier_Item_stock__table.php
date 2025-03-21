<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrantTierItemStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrant_tier_item_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrant_id');
            $table->integer('tier_item_stock_id');
            $table->enum('claim_status',
                [
                    'PENDING',
                    'CLAIMED',
                    'REJECTED',
                    'ON_HOLD',
                    'DISPATCHED',
                ])->default('PENDING');
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
        Schema::dropIfExists('entrant_tier_stock_items');
        Schema::dropIfExists('entrant_tier_item_stock');
    }
}
