<?php


namespace Modules\Exchanger1C\Entities;


use App\Media;
use Bigperson\Exchange1C\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use Zenwalker\CommerceML\CommerceML;

class Product extends Model implements ProductInterface
{
    protected $table = 'altrp_exchanger1c_products';

    protected $guarded = [];


    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }

    /**
     * Если по каким то причинам файлы import.xml или offers.xml были модифицированы и какие то данные
     * не попадают в парсер, в самом конце вызывается данный метод, в $product и $cml можно получить все
     * возможные данные для ручного парсинга
     *
     * @param CommerceML $cml
     * @param \Zenwalker\CommerceML\Model\Product $product
     * @return void
     */
    public function setRaw1cData($cml, $product)
    {

    }

    public function getPrimaryKey()
    {
        return 'id';
    }

    public function setRequisite1c($name, $value)
    {
        if (!$requisite = Requisite::where('name', $name)->first()) {
            $requisite = new Requisite();
            $requisite->name = $name;
            $requisite->save();
        }
        $this->requisites()->detach($requisite);
        $this->requisites()->attach($requisite);
    }

    public function setGroup1c($group)
    {
        if ($group->id && ($item = Group::where('accounting_id', $group->id)->first())) {
            $this->update(['group_id' => $item->id]);
        }
    }

    public function setProperty1c($property)
    {
        $propertyModel = Property::where('accounting_id', $property->id)->first();
        $propertyValue = $property->getValueModel();
        if ($propertyAccountingId = (string)$propertyValue->ИдЗначения) {
            $value = PropertyValue::where('accounting_id', $propertyAccountingId)->first();
            $attributes = ['property_value_id' => $value->id];
        } else {
            $attributes = [
                'property_value_id' => null,
                'value' => $propertyValue->value
            ];
        }
        $this->properties()->detach($propertyModel);
        $this->properties()->attach($propertyModel, $attributes);
    }

    public function addImage1c($path, $caption)
    {
//        if (!$this->getImages()->where('filename', $path)->first()) {
        $media = uploadMedia($path, $caption);
        $this->images()->attach($media, ['caption' => $caption], false);
//        }
    }

    public function getGroup1c()
    {
        return $this->group;
    }

    public static function createProperties1c($properties)
    {
        /**
         * @var \Zenwalker\CommerceML\Model\Property $property
         */
        foreach ($properties as $property) {
            $propertyModel = Property::createByMl($property);
            foreach ($property->getAvailableValues() as $value) {
                if (!$propertyValue = PropertyValue::where('accounting_id', $value->id)->first()) {
                    $propertyValue = new PropertyValue();
                    $propertyValue->name = (string)$value->Значение;
                    $propertyValue->property_id = $propertyModel->id;
                    $propertyValue->accounting_id = (string)$value->ИдЗначения;
                    $propertyValue->save();
                    unset($propertyValue);
                }
            }
        }
    }

    public function getOffer1c($offer)
    {
        $offerModel = Offer::createByMl($offer);
        $offerModel->product_id = $this->id;
        if ($offerModel->getDirty()) {
            $offerModel->save();
        }
        return $offerModel;
    }

    public static function createModel1c($product)
    {
        $cml = $product->owner;
        if (!$catalog = Catalog::where('accounting_id',  $cml->catalog->id)->first()) {
            $catalog = new Catalog();
            $catalog->accounting_id = $cml->catalog->id;
        }
        $catalog->name = $cml->catalog->name;
        $catalog->save();
        if (!$model = Product::where('accounting_id', $product->id)->first()) {
            $model = new Product();
            $model->accounting_id = $product->id;
        }
        $model->name = $product->name;
        $model->description = (string)$product->Описание;
        $model->article = (string)$product->Артикул;
        $model->catalog_id = $catalog->id;
        $model->save();
        return $model;
    }

    public static function findProductBy1c(string $id): ?self
    {
        return new self();
    }

    public function requisites()
    {
        return $this->belongsToMany(
            Requisite::class,
            'altrp_exchanger1c_product_requisite'
        );
    }

    public function properties()
    {
        return $this->belongsToMany(
            Property::class,
            'altrp_exchanger1c_product_props');
    }

    public function images()
    {
        return $this->belongsToMany(Media::class, 'altrp_exchanger1c_product_images');
    }

    public function group()
    {
        return $this->hasOne(Group::class);
    }

    protected function getImages()
    {
        return Media::all();
    }
}
