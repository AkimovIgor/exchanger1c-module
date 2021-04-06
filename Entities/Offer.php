<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\GroupInterface;
use Bigperson\Exchange1C\Interfaces\OfferInterface;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model implements OfferInterface
{
    protected $table = 'altrp_exchanger1c_offers';

    public static function createByMl($offer)
    {
        if (!$offerModel = self::where('accounting_id', $offer->id)->first()) {
            $offerModel = new self;
            $offerModel->name = (string)$offer->name;
            $offerModel->accounting_id = (string)$offer->id;
        }
        $offerModel->remnant = (string)$offer->Количество;
        return $offerModel;
    }

    public function getExportFields1c($context = null)
    {
        /**
         * @var Document $context
         */
        $pv = DocumentOffer::where([
            ['offer_id', $this->id],
            ['order_id', $context->id]
        ])->first();
        return [
            'Ид' => $this->accounting_id,
            'Наименование' => $this->name,
            'ЦенаЗаЕдиницу' => $this->getMainPrice()->value,
            'Сумма' => $pv->sum,
            'Количество' => $pv->count,
            'БазоваяЕдиница' => [
                '@content' => 'шт',
                '@attributes' => [
                    'Код' => '796',
                    'НаименованиеПолное' => 'Штука',
                    'МеждународноеСокращение' => 'PCE'
                ]
            ]
        ];
    }

    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }

    public function getPrimaryKey()
    {
        return 'id';
    }

    public function getGroup1c()
    {
        return $this->product->group;
    }

    /**
     * offers.xml > ПакетПредложений > Предложения > Предложение > Цены
     *
     * Цена товара,
     * К $price можно обратиться как к массиву, чтобы получить список цен (Цены > Цена)
     * $price->type - тип цены (offers.xml > ПакетПредложений > ТипыЦен > ТипЦены)
     *
     * @param \Zenwalker\CommerceML\Model\Price $price
     * @return void
     */
    public function setPrice1c($price)
    {
        $priceType = PriceType::where('accounting_id', $price->getType()->id);
        $priceModel = Price::createByMl($price, $this, $priceType);
        $this->prices()->detach($priceModel);
        $this->prices()->attach($priceModel);
    }

    public static function createPriceTypes1c($types)
    {
        foreach ($types as $type) {
            PriceType::createByMl($type);
        }
    }

    public function setSpecification1c($specification)
    {
        $specificationModel = Specification::createByMl($specification);
        $this->specifications()->detach($specificationModel);
        $this->specifications()->attach(
            $specificationModel,
            ['value' => (string)$specification->Значение],
            false
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class, 'altrp_exchanger1c_offer_prices');
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'altrp_exchanger1c_offer_spec');
    }

    protected function getMainPrice()
    {
        return $this->prices()->first();
    }
}
