<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\DocumentInterface;
use Bigperson\Exchange1C\Interfaces\PartnerInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Document extends Model implements DocumentInterface, PartnerInterface
{
    protected $table = 'altrp_exchanger1c_documents';


    public static function findDocuments1c()
    {
        return self::where('status_id', 2)->get()->toArray();
    }

    public function getOffers1c()
    {
        return $this->offers;
    }

    public function getRequisites1c()
    {
        // TODO: Implement getRequisites1c() method.
    }

    public function getPartner1c()
    {
        return $this->partner;
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'altrp_exchanger1c_order_offers');
    }

    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    public function getExportFields1c($context = null)
    {
        return [
            'Ид' => 'id',
            'Номер' => 'id',
            'Дата' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'Время' => Carbon::parse($this->created_at)->format('H:i:s'),
            'ХозОперация' => 'Заказ товара',
            'Роль' => 'Продавец',
            'Валюта' => 'RUB',
            'Курс' => '1',
            'Сумма' => $this->sum,
            'ЗначенияРеквизитов' => [
//                [
//                    '@name' => 'ЗначениеРеквизита',
//                    '@content' => ['Наименование' => 'Метод оплаты', 'Значение' => 'Наличный расчет']
//                ],
//                [
//                    '@name' => 'ЗначениеРеквизита',
//                    '@content' => ['Наименование' => 'Заказ оплачен', 'Значение' => 'true']
//                ],
//                [
//                    '@name' => 'ЗначениеРеквизита',
//                    '@content' => ['Наименование' => 'Доставка разрешена', 'Значение' => 'true']
//                ],
                [
                    '@name' => 'ЗначениеРеквизита',
                    '@content' => ['Наименование' => 'Статус заказа', 'Значение' => 'Согласовано']
                ],
//                [
//                    '@name' => 'ЗначениеРеквизита',
//                    '@content' => ['Наименование' => 'Финальный статус', 'Значение' => 'true']
//                ],
            ]
//            'Оплаты'      => [
//                'Оплата' => [
//                    'НомерДокумента'   => 'avangard' . $this->id,
//                    'НомерТранзакции ' => 'avangard' . $this->id,
//                    'ДатаОплаты'       => $this->paid_at,
//                    'СуммаОплаты'      => $this->total_sum,
//                    'СпособОплаты'     => 'Авангард',
//                    'ИдСпособаОплаты'  => 'visa',
//                ]
//            ],
        ];
    }
}
