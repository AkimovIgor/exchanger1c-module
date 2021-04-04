<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COfferWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_offer_warehouses', function (Blueprint $table) {
            $table->integer('offer_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();

            $table->primary([
                'offer_id',
                'warehouse_id'
            ], '1c');

            $table->foreign('offer_id', 'of_id')
                ->references('id')
                ->on('altrp_exchanger1c_offers');

            $table->foreign('warehouse_id', 'ws_id')
                ->references('id')
                ->on('altrp_exchanger1c_warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_offer_warehouses');
    }
}
