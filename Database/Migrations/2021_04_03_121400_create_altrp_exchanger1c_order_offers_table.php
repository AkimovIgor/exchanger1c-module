<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COrderOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_order_offers', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('offer_id')->unsigned();
            $table->decimal('count', 10, 3);
            $table->decimal('sum', 10, 2);
            $table->integer('price_type_id')->unsigned();

            $table->primary([
                'order_id',
                'offer_id'
            ]);

            $table->foreign('order_id')
                ->references('id')
                ->on('altrp_exchanger1c_orders');

            $table->foreign('offer_id')
                ->references('id')
                ->on('altrp_exchanger1c_offers');

            $table->foreign('price_type_id', 'pt_id')
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
        Schema::dropIfExists('altrp_exchanger1c_order_offers');
    }
}
