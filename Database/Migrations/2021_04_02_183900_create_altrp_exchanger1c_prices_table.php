<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('performance', 255);
            $table->decimal('value', 10, 2);
            $table->string('currency', 255);
            $table->float('rate', 255);
            $table->integer('type_id')->unsigned()->nullable();

            $table->foreign('type_id')
                ->references('id')
                ->on('altrp_exchanger1c_price_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_prices');
    }
}
