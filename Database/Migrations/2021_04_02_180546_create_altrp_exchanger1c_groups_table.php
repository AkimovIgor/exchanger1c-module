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
            $table->string('name')->comment('Наименование группы');
            $table->integer('parent_id')->unsigned()->nullable()->comment('Родительская группа');
            $table->string('accounting_id')->unique()->comment('Код в 1С');
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
