<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1CGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('altrp_exchanger1c_groups');
            $table->string('accounting_id')->unique();
            $table->timestamps();
            $table->boolean('is_active')
                ->nullable(false)
                ->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_groups');
    }
}
