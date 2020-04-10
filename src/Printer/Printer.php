<?php

namespace Cblink\Feieyun\Printer;

use Cblink\Feieyun\Client;

class Printer extends Client
{
    public function addPrinter($sn, $key, $alias = '', $phone = '')
    {
        $printerInfo = array_filter([
            $sn, $key, $alias, $phone
        ]);


        $printerContent = implode('#', $printerInfo);

        return $this->post('Open_printerAddlist', compact('printerContent'));
    }

    public function createPrinterTask($sn, $content, $times = 1)
    {
        return $this->post('Open_printMsg', compact('sn', 'content', 'times'));
    }

    public function createPrinterLabelTask($sn, $content, $img = '', $times = 1)
    {
        return $this->post('Open_printMsg', compact('sn', 'content', 'img', 'times'));
    }

    public function removePrinter($sn)
    {
        return $this->post('Open_printerDelList', compact('sn'));
    }

    public function editPrinterInfo($sn, $name, $phone = '')
    {
        return $this->post('Open_printerEdit', compact('sn', 'name', 'phone'));
    }

    public function cancelUnprintTaskBySn($sn)
    {
        return $this->post('Open_delPrinterSqs', compact('sn'));
    }

    public function queryTask($orderid)
    {
        return $this->post('Open_queryOrderState', compact('orderid'));
    }

    public function queryOrderInfoBySnAndDate($sn, $date)
    {
        return $this->post('Open_queryOrderInfoByDate', compact('sn', 'date'));
    }

    public function queryPrinterStatusBySn($sn)
    {
        return $this->post('Open_queryPrinterStatus', compact('sn'));
    }
}