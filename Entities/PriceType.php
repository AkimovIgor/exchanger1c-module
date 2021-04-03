<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    protected $table = 'altrp_exchanger1c_price_types';

    /**
     * @param $type
     * @return PriceType
     */
    public static function createByMl($type)
    {
        if (!$priceType = self::where('accounting_id', $type->id)->first()) {
            $priceType = new self;
            $priceType->accounting_id = $type->id;
        }
        $priceType->name = $type->name;
        $priceType->currency = (string)$type->Валюта;
        if ($priceType->getDirty()) {
            $priceType->save();
        }
        return $priceType;
    }
}
