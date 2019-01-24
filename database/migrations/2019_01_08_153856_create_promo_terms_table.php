<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('version');
            $table->integer('promotion_id');
            $table->dateTime('valid_from');
            $table->dateTime('valid_until')->nullable();
            $table->integer('authorised_by_user_id')->nullable();
            $table->dateTime('authorised_at')->nullable();
            $table->string('title');
            $table->longText('acceptance_text');
            $table->string('short_terms')->nullable();
            $table->longText('terms_body_text');
            $table->timestamps();
            $table->integer('created_by_user_id')->nullable();
            $table->integer('updated_by_user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_terms');
    }
}
