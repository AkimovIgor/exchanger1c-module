<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'altrp_exchanger1c_prices';

    /**
     * @param \Zenwalker\CommerceML\Model\Price $price
     * @param Offer $offer
     * @param PriceType $type
     * @return Price
     */
    public static function createByMl($price, $offer, $type)
    {
        if (!$priceModel = $offer->prices()->where('type_id', $type->id)->first()) {
            $priceModel = new self();
        }
        $priceModel->value = $price->cost;
        $priceModel->performance = $price->performance;
        $priceModel->currency = $price->currency;
        $priceModel->rate = $price->rate;
        $priceModel->type_id = $type->id;
        $priceModel->save();
        return $priceModel;
    }
}
