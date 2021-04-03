<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('accounting_id', 255);
            $table->integer('product_id')->unsigned()->nullable();
            $table->float('remnant', 10, 3);
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_offers');
    }
}
