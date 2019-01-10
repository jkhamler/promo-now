<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrnSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urn_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_id')->nullable();
            $table->integer('promotion_id')->nullable();
            $table->enum('purpose', [
                \App\Models\UrnSpecification::URN_PURPOSE_PRINTERS,
                \App\Models\UrnSpecification::URN_PURPOSE_CUSTOMER_SERVICE,
                \App\Models\UrnSpecification::URN_PURPOSE_BRAND_TESTING,
                \App\Models\UrnSpecification::URN_PURPOSE_PI_TESTING,
            ])->nullable();
            $table->integer('length');
            $table->string('included_characters')->nullable();
            $table->string('regex_exclude')->nullable();
            $table->integer('profanity_check_language_id')->nullable();
            $table->integer('urn_quantity')->nullable();
            $table->integer('winning_urn_quantity')->nullable();
            $table->boolean('pi_to_generate')->nullable();
            $table->boolean('everyone_gets')->nullable();
            $table->boolean('allocated_by_tier')->nullable();
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
        Schema::dropIfExists('urn_specifications');
    }
}
