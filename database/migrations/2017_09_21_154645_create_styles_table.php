
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//$table->decimal('ms',9, 4)->comment('Maple Select')->default(0);
//$table->decimal('mr', 9, 4)->comment('Maple Regular')->default(0);
//$table->decimal('mp', 9, 4)->comment('Maple Paint')->default(0);
//$table->decimal('mmdf', 9, 4)->comment('Maple MDF')->default(0);
//$table->decimal('or', 9, 4)->comment('Oak Regular')->default(0);
//$table->decimal('mrmdf', 9, 4)->comment('Maple Regular MDF')->default(0);
//$table->decimal('cr', 9, 4)->comment('Cherry Regular')->default(0);

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('style');
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
        Schema::dropIfExists('styles');
    }
}

