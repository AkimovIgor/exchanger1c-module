<?php

return [
    'exchange_path' => env('EXCHANGER1C_EXCHANGE_PATH', '1c_exchanger'),
    'import_dir'    => storage_path(env('EXCHANGER1C_IMPORT_DIR', 'app/1c_exchange')),
    'login'         => env('EXCHANGER1C_LOGIN', 'admin'),
    'password'      => env('EXCHANGER1C_PASSWORD', 'admin'),
    'use_zip'       => env('EXCHANGER1C_USE_ZIP', true),
    'file_part'     => (int)env('EXCHANGER1C_FILE_PART', 0),
    'models'        => [
        \Bigperson\Exchange1C\Interfaces\GroupInterface::class   => \Modules\Exchanger1C\Entities\Group::class,
        \Bigperson\Exchange1C\Interfaces\ProductInterface::class => \Modules\Exchanger1C\Entities\Product::class,
        \Bigperson\Exchange1C\Interfaces\OfferInterface::class   => \Modules\Exchanger1C\Entities\Offer::class,
        \Bigperson\Exchange1C\Interfaces\PartnerInterface::class   => \Modules\Exchanger1C\Entities\Partner::class,
        \Bigperson\Exchange1C\Interfaces\DocumentInterface::class   => \Modules\Exchanger1C\Entities\Document::class,
        \Bigperson\Exchange1C\Interfaces\WarehouseInterface::class   => \Modules\Exchanger1C\Entities\Warehouse::class,
    ],
];
