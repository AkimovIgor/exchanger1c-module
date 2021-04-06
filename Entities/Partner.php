<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\PartnerInterface;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model implements PartnerInterface
{
    protected $table = 'altrp_exchanger1c_partners';

    public function getExportFields1c($context = null)
    {
        return [
            'Ид' => 'id',
            'Наименование' => 'username',
            'ПолноеНаименование' => 'full_name',
            'Фамилия' => 'surname',
            'Имя' => 'name',
        ];
    }
}
