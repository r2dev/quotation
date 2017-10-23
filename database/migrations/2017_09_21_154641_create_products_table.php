<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('design');
            $table->decimal('price_0', 9, 4)->default(0); //Maple Select
            $table->decimal('price_1', 9, 4)->default(0); //Maple Regular
            $table->decimal('price_2', 9, 4)->default(0); //Maple Paint
            $table->decimal('price_3', 9, 4)->default(0); //Maple MDF
            $table->decimal('price_4', 9, 4)->default(0); //Oak Regular
            $table->decimal('price_5', 9, 4)->default(0); //Maple Regular MDF
            $table->decimal('price_6', 9, 4)->default(0); //Cherry Regular
            $table->decimal('price_7', 9, 4)->default(0);
            $table->decimal('price_8', 9, 4)->default(0);
            $table->decimal('price_9', 9, 4)->default(0);
            $table->decimal('price_10', 9, 4)->default(0);
            $table->decimal('price_11', 9, 4)->default(0);
            $table->decimal('price_12', 9, 4)->default(0);
            $table->boolean('frame')->default(false);
            $table->string('profile_size')->default('3');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
