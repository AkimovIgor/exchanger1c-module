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
            $table->string('accounting_id', 255)->unique();
            $table->integer('group_id')->unsigned()->nullable();

            $table->foreign('group_id')
                ->references('id')
                ->on('altrp_exchanger1c_groups');

            $table->integer('catalog_id')->unsigned()->nullable();

            $table->foreign('catalog_id')
                ->references('id')
                ->on('altrp_exchanger1c_catalogs');

            $table->boolean('is_active')
                ->nullable(false)
                ->default(true);

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
