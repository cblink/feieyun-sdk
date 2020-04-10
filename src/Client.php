<?php

namespace Cblink\Feieyun;

use Cblink\Feieyun\Exceptions\FeieyunApiException;
use Mouyong\Foundation\AbstractClient;

class Client extends AbstractClient
{
    protected $apiname;

    public function post($action, $data = [], $options = [])
    {
        $this->apiname = $action;

        return parent::post('', $data, $options);
    }

    public function sign(array $data = []): array
    {
        $data['user'] = $this->app->options['user'];
        $data['stime'] = time();
        $data['debug'] = $this->app->options['debug'];

        $sign = sha1("{$data['user']}{$this->app->options['ukey']}{$data['stime']}");

        $data['sig'] = $sign;
        $data['apiname'] = $this->apiname;

        return $data;
    }

    public function request(string $method, string $uri, array $options = [])
    {
        $response = $this->app->http->request($method, $uri, $options);

        return $this->castResponseToType($response);
    }

    public function castResponseToType($response)
    {
        $data = json_decode($response->getBody()->getContents(), true);

//        if (!empty($data['ret']) && $data['ret'] !== 0) {
//            throw new FeieyunApiException($data['msg'], $data['ret']);
//        }
//
//        if (!empty($data['no'])) {
//            throw new FeieyunApiException(reset($data['no']));
//        }

        return $data;
    }
}