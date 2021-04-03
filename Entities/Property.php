<?php


namespace Modules\Exchanger1C\Entities;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'altrp_exchanger1c_props';

    public static function createByML(\Zenwalker\CommerceML\Model\Property $property)
    {
        /**
         * @var \Zenwalker\CommerceML\Model\Group $parent
         */
        if (!$model = Property::where('accounting_id', $property->id)->first()) {
            $model = new self;
            $model->accounting_id = $property->id;
        }
        $model->name = $property->name;
        if ($parent = $property->getParent()) {
            $parentModel = self::createByML($parent);
            $model->parent_id = $parentModel->id;
            unset($parentModel);
        } else {
            $model->parent_id = null;
        }
        $model->save();
        return $model;
    }
}
