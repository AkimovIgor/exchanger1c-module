<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('altrp_exchanger1c_product_images');
        Schema::create('altrp_exchanger1c_product_images', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->bigInteger('media_id')->unsigned();

            $table->primary([
                'product_id',
                'media_id'
            ], '1c');

            $table->foreign('product_id', 'pr_id')
                ->references('id')
                ->on('altrp_exchanger1c_products');

            $table->foreign('media_id')
                ->references('id')
                ->on('altrp_media');

            $table->string('caption', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_product_images');
    }
}
