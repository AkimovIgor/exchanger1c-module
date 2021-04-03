<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductProperty extends Pivot
{
    protected $table = 'altrp_exchanger1c_product_props';
}
