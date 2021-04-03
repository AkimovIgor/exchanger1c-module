<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\DocumentInterface;
use Illuminate\Database\Eloquent\Model;

class Document extends Model implements DocumentInterface
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
        return $this->belongsToMany(Offer::class)
            ->using(DocumentOffer::class);
    }

    public function partner()
    {
        return $this->hasOne(Partner::class);
    }
}
