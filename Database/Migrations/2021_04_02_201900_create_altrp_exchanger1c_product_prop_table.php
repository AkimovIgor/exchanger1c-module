<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CProductPropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_product_props', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('property_id')->unsigned();

            $table->foreign('product_id', 'p')
                ->references('id')
                ->on('altrp_exchanger1c_products');

            $table->foreign('property_id', 'pp')
                ->references('id')
                ->on('altrp_exchanger1c_props');

            $table->primary([
                'product_id',
                'property_id'
            ], '1c');

            $table->integer('property_value_id')->unsigned()->nullable();

            $table->foreign('property_value_id', 'pv')
                ->references('id')
                ->on('altrp_exchanger1c_prop_values');

            $table->string('value', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_product_props');
    }
}
