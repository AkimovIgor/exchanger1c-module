<?php


namespace Modules\Exchanger1C\Entities;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'altrp_exchanger1c_catalogs';

    public function products()
    {
        return $this->hasMany(Product::class, 'catalog_id');
    }
}
