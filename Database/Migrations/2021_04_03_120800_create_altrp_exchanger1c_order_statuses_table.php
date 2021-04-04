<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltrpExchanger1COrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altrp_exchanger1c_order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
        });

        $statuses = [
            ['name' => 'Согласован'],
            ['name' => 'Не согласован'],
            ['name' => 'Закрыт'],
        ];
        \Modules\Exchanger1C\Entities\DocumentStatus::insert($statuses);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altrp_exchanger1c_order_statuses');
    }
}
