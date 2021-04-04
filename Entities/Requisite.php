<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Model;

class Requisite extends Model
{
    protected $table = 'altrp_exchanger1c_requisites';

    public $timestamps = false;

    public function productRequisite()
    {
        return $this->hasMany(ProductRequisitePivot::class, 'requisite_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'altrp_exchanger1c_product_requisite');
    }
}
