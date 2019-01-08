<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrantPrivacyTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrant_privacy_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrant_id');
            $table->integer('version_id');
            $table->integer('accepted_privacy_terms_id');
            $table->integer('marketing_opt_in');
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
        Schema::dropIfExists('entrant_privacy_terms');
    }
}
