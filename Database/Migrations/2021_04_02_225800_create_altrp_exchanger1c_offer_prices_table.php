<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COfferPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_offer_prices', function (Blueprint $table) {
            $table->integer('offer_id')->unsigned();
            $table->integer('price_id')->unsigned();

            $table->primary([
                'offer_id',
                'price_id'
            ]);

            $table->foreign('offer_id')
                ->references('id')
                ->on('altrp_exchanger1c_offers');

            $table->foreign('price_id')
                ->references('id')
                ->on('altrp_exchanger1c_prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_offer_prices');
    }
}
