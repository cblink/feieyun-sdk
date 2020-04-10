<?php

namespace Cblink\Feieyun;

use Cblink\Feieyun\Printer\Printer;
use Cblink\Feieyun\Printer\PrinterServiceProvider;
use Mouyong\Foundation\Foundation;

/**
 * Class Application
 * @package Cblink\Feieyun
 *
 * @property-read Printer $printer
 */
class Application extends Foundation
{
    protected $config = [
        'debug' => 0,

        'user' => 'your-feieyun-user',
        'ukey' => 'your-feieyun-ukey',

        'log' => [
            'name' => 'feieyun',
        ],
        'http' => [
            'timeout' => 3,
            'base_uri' => 'http://api.feieyun.cn/Api/Open',
            'http_errors' => false,
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
                'accept' => 'application/json',
            ],
        ],
        'cache' => [
            'namespace' => 'feieyun',
        ],
    ];

    protected $providers = [
        PrinterServiceProvider::class,
    ];
}