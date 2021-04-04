<?php


namespace Modules\Exchanger1C\Entities;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'altrp_exchanger1c_props';

    public static function createByML(\Zenwalker\CommerceML\Model\Property $property)
    {
        if (!$model = self::where('accounting_id', $property->id)->first()) {
            $model = new self;
            $model->accounting_id = $property->id;
            $model->name = $property->name;
            $model->save();
        }
        return $model;
    }

    public function propertyValues()
    {
        return $this->hasMany(PropertyValue::class, 'property_id');
    }

    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class, 'property_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'altrp_exchanger1c_product_props');
    }
}
