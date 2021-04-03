<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COfferSpecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_offer_spec', function (Blueprint $table) {
            $table->integer('offer_id')->unsigned();
            $table->integer('specification_id')->unsigned();
            $table->string('value', 255);
        });

        Schema::table('altrp_exchanger1c_offer_spec', function (Blueprint $table) {
            $table->primary([
                'offer_id',
                'specification_id'
            ], '1c');
        });

        Schema::table('altrp_exchanger1c_offer_spec', function (Blueprint $table) {
            $table->foreign('offer_id', 'o_id')
                ->references('id')
                ->on('altrp_exchanger1c_offers');

            $table->foreign('specification_id', 's_id')
                ->references('id')
                ->on('altrp_exchanger1c_specifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_offer_spec');
    }
}
