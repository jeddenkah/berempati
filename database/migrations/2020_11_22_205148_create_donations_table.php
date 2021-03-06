<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->foreign('user_id')->references('id')->on('users');
            $table->foreignId('crowdfund_id')->foreign('crowdfund_id')->references('id')->on('crowdfunds');
            $table->unsignedBigInteger('nominal');
            $table->string('message')->nullable();
            $table->boolean('is_anonym');
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
        Schema::dropIfExists('donations');
    }
}
