<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferSpecification extends Pivot
{
    protected $table = 'altrp_exchanger1c_offer_spec';
}
