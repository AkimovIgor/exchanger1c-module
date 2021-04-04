<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferWarehouse extends Pivot
{
    protected $table = 'altrp_exchanger1c_offer_warehouses';
}
