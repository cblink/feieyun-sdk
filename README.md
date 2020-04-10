<h1 align="center"> feieyun-sdk </h1>

<p align="center"> feieyun options.</p>


## Installing

```shell
$ composer require cblink/feieyun-sdk -vvv
```

## Usage


```
use Cblink\Feieyun\Application;

$config = [
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

$app = new Application($config);

// 添加打印机
$app->printer->addPrinter($sn, $key, $alias, $phone)

// 从账号下终端打印机
$app->printer->removePrinter($sn);

// 创建文本打印任务
$app->printer->createPrinterTask($sn, $content, $times = 1);

// 创建标签打印任务
$app->printer->createPrinterLabelTask($sn, $content, $img = '', $times = 1);

// 修改打印机信息
$app->printer->editPrinterInfo($sn, $name, $phone = '');

// 取消终端所有未打印任务
$app->printer->cancelUnprintTaskBySn($sn);

// 获取终端状态
$app->printer->queryPrinterStatusBySn($sn);

// 查询指定打印机某天的订单统计数
$app->printer->queryOrderInfoBySnAndDate($machine_code);

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink/feieyun-sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink/feieyun-sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT