<?php

namespace Cblink\Feieyun\Printer;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PrinterServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['printer'] = function ($pimple) {
            return new Printer($pimple);
        };
    }
}