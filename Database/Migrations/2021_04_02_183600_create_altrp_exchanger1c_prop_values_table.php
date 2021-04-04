<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CPropValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_prop_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();

            $table->foreign('property_id')
                ->references('id')
                ->on('altrp_exchanger1c_props');

            $table->string('name', 255);
            $table->string('accounting_id', 255);
            $table->timestamps(); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_prop_values');
    }
}
