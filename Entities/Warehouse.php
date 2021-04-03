<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\WarehouseInterface;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model implements WarehouseInterface
{
    protected $table = 'altrp_exchanger1c_warehouses';

    public static function getIdFieldName1c()
    {
        return [
            'Ид' => 'id',
            'Наименование' => 'login',
            'ПолноеНаименование' => 'full_name',
            'Фамилия' => 'surname',
            'Имя' => 'name',
            'Контакты' => [
                [
                    '@name' => 'Контакт',
                    'Тип' => 'Почта',
                    'Значение' => '',
                ],
                [
                    '@name' => 'Контакт',
                    'Тип' => 'ТелефонРабочий',
                    'Значение' => '',
                ],
            ],
        ];
    }

    public function getPrimaryKey()
    {
        return 'id';
    }
}
