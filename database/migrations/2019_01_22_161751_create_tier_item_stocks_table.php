<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTierItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tier_item_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tier_item_id');
            $table->dateTime('allocated_datetime')->nullable();
            $table->string('reference_number')->nullable();
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
        Schema::dropIfExists('tier_item_stock');
    }
}
