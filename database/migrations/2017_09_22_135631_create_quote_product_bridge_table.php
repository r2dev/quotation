<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteProductBridgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('price', 9, 4)->default(0);
            $table->string('style')->default('');
            $table->integer('quantity')->unsigned()->default(0);
            $table->integer('style_id')->unsigned();
            $table->string('height')->default('0');
            $table->string('width')->default('0');
            $table->integer('lite')->unsigned()->default(0);
            $table->string('adjustment')->default('0');
            $table->string('adjustment_lr')->default('0');
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
        Schema::dropIfExists('quote_product');
    }
}
