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
            $table->decimal('ms',9, 4)->comment('Maple Select')->default(0);
            $table->decimal('mr', 9, 4)->comment('Maple Regular')->default(0);
            $table->decimal('mp', 9, 4)->comment('Maple Paint')->default(0);
            $table->decimal('mmdf', 9, 4)->comment('Maple MDF')->default(0);
            $table->decimal('or', 9, 4)->comment('Oak Regular')->default(0);
            $table->decimal('mrmdf', 9, 4)->comment('Maple Regular MDF')->default(0);
            $table->decimal('cr', 9, 4)->comment('Cherry Regular')->default(0);
            $table->integer('min_lite')->default(0);
            $table->integer('max_lite')->default(0);
            $table->integer('min_width')->default(0);
            $table->integer('max_width')->default(0);
            $table->integer('min_height')->default(0);
            $table->integer('max_height')->default(0);
            $table->integer('min_area')->default(0);
            $table->integer('max_area')->default(0);
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
