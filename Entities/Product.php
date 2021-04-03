<?php


namespace Modules\Exchanger1C\Entities;


use App\Media;
use Bigperson\Exchange1C\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductInterface
{
    protected $table = 'altrp_exchanger1c_products';


    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }

    public function getPrimaryKey()
    {
        return 'id';
    }

    public function setRaw1cData($cml, $product)
    {
        // TODO: Implement setRaw1cData() method.
    }

    public function setRequisite1c($name, $value)
    {
        if (!$requisite = Requisite::where('name', $name)->first()) {
            $requisite = new Requisite();
            $requisite->name = $name;
            $requisite->save();
        }
        $this->requisites()->attach($requisite);
    }

    public function setGroup1c($group)
    {
        $group = Group::where('accounting_id', $group->id)->first();
        $this->update(['group_id' => $group->id]);
    }

    public function setProperty1c($property)
    {
        $propertyModel = Property::where('accounting_id', $property->id)->first();
        $propertyValue = $property->getValueModel();
        if ($propertyAccountingId = (string)$propertyValue->ИдЗначения) {
            $value = PropertyValue::where('accounting_id', $propertyAccountingId)->first();
            $attributes = ['property_value_id' => $value->id];
        } else {
            $attributes = ['value' => $propertyValue->value];
        }
        $this->properties()->attach($propertyModel, $attributes, false);
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
        if ($offerModel->getDirtyAttributes()) {
            $offerModel->save();
        }
        return $offerModel;
    }

    public static function createModel1c($product)
    {
        if (!$model = Product::where('accounting_id', $product->id)->first()) {
            $model = new Product();
            $model->accounting_id = $product->id;
        }
        $model->name = $product->name;
        $model->description = (string)$product->Описание;
        $model->article = (string)$product->Артикул;
        $model->save();
        return $model;
    }

    public static function findProductBy1c(string $id): ?self
    {
        return new self();
    }

    public function requisites()
    {
        return $this->belongsToMany(Requisite::class)
            ->using(ProductRequisitePivot::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->using(ProductProperty::class);
    }

    public function images()
    {
        return $this->belongsToMany(Media::class)
            ->using(ProductImage::class);
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
