<?php

return [
    'exchange_path' => '1c_exchange',
    'import_dir'    => storage_path('app/1c_exchange'),
    'login'         => env('EXCHANGER1C_LOGIN', 'admin'),
    'password'      => env('EXCHANGER1C_PASSWORD', 'admin'),
    'use_zip'       => false,
    'file_part'     => 0,
    'models'        => [
        \Bigperson\Exchange1C\Interfaces\GroupInterface::class   => \Modules\Exchanger1C\Entities\Group::class,
        \Bigperson\Exchange1C\Interfaces\ProductInterface::class => \Modules\Exchanger1C\Entities\Product::class,
        \Bigperson\Exchange1C\Interfaces\OfferInterface::class   => \Modules\Exchanger1C\Entities\Offer::class,
        \Bigperson\Exchange1C\Interfaces\PartnerInterface::class   => \Modules\Exchanger1C\Entities\Partner::class,
        \Bigperson\Exchange1C\Interfaces\DocumentInterface::class   => \Modules\Exchanger1C\Entities\Document::class,
        \Bigperson\Exchange1C\Interfaces\WarehouseInterface::class   => \Modules\Exchanger1C\Entities\Warehouse::class,
    ],
];
