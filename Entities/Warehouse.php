<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\WarehouseInterface;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'altrp_exchanger1c_warehouses';

    public function offerWarehouses()
    {
        return $this->hasMany(OfferWarehouse::class, 'warehouse_id');
    }

    public function offers()
    {

    }
}
