<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('qutation_id')->default('');
            $table->string('terms')->default('30% Deposit COD');
            $table->string('style_id')->default('0');
            $table->string('panel')->default('');
            $table->string('po')->default('');
            $table->string('door_style')->default('');
            $table->string('lip')->default('NONE');
            $table->string('moulding')->default('NONE');
            $table->boolean('customer_confirmed')->default(false);
            $table->boolean('staff_confirmed')->default(false);
            $table->boolean('cm')->default(false);
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
            $table->timestamp('confirmed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
