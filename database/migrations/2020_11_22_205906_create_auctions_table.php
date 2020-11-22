<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->foreign('user_id')->references('id')->on('users');
            $table->foreignId('crowdfund_id')->foreign('crowdfund_id')->references('id')->on('crowdfunds');
            $table->string('image');
            $table->text('desc');
            $table->unsignedBigInteger('start_nominal');
            $table->date('target_date');
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
        Schema::dropIfExists('auctions');
    }
}
