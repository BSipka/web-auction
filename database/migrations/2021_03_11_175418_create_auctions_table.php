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
            $table->integer('item_id')->unsigned();
            $table->integer('category_id');
            $table->integer('sold_to')->unsigned()->nullable();
            $table->timestamp('sold_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('valid_until')->default(Carbon\Carbon::now()->addDays(10));
            $table->float('largest_bid');
            
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('sold_to')->references('id')->on('users');
        
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
