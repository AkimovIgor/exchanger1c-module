<?php


namespace Modules\Exchanger1C\Entities;


use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'altrp_exchanger1c_specifications';

    public static function createByMl($specification)
    {
        if (!$specificationModel = self::where('accounting_id', $specification->id)->first()) {
            $specificationModel = new self;
            $specificationModel->name = $specification->name;
            $specificationModel->accounting_id = $specification->id;
            $specificationModel->save();
        }
        return $specificationModel;
    }
}
