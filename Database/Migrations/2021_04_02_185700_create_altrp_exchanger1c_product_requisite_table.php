<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CProductRequisiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_product_requisite', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id', 'p_id')
                ->references('id')
                ->on('altrp_exchanger1c_products');

            $table->integer('requisite_id')->unsigned();
            $table->foreign('requisite_id', 'r_id')
                ->references('id')
                ->on('altrp_exchanger1c_requisites');

            $table->primary([
                'product_id',
                'requisite_id'
            ], '1c');
            $table->string('value', 1024);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_product_requisite');
    }
}
