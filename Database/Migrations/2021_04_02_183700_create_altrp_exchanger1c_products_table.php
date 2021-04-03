<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('article', 255);
            $table->string('description', 255)->nullable();
            $table->string('accounting_id', 255);
            $table->integer('group_id')->unsigned();
            $table->integer('catalog_id')->unsigned();
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_products');
    }
}
