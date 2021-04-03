<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Relations\Pivot;

class DocumentOffer extends Pivot
{
    protected $table = 'altrp_exchanger1c_order_offers';
}
