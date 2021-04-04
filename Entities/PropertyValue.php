<?php


namespace Modules\Exchanger1C\Entities;

use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    protected $table = 'altrp_exchanger1c_prop_values';

    public $timestamps = false;

    public function property()
    {
        return $this->hasOne(Property::class);
    }

    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class, 'property_value_id');
    }
}
