<?php
    require __DIR__.'/vendor/autoload.php';
    
    $config = [
        'user'=>'kelaocai@cblink.net',
        'ukey'=>'EcNkTW9pVAe6Yw27',
    ];
    $f = new \Cblink\FeieyunSdk\HttpClient($config);
    
    
    /**********添加打印机***********/

//    批量添加规则：
//    打印机编号SN(必填) # 打印机识别码KEY(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100行(台)。
//    每次最多添加100台。
    $printerContent = " 316500010 # abcdefgh # 快餐前台 # 13688889999\n316500011 # abcdefgh # 快餐厨房 # 13688889990";
//    $response  = $f->addPrinter($printerContent);
    
    //正确返回：{"msg":"ok","ret":0,"data":{"ok":["sn#key#remark#carnum","316500011#abcdefgh#快餐前台"],"no":["316500012#abcdefgh#快餐前台#13688889999  （错误：识别码不正确）"]},"serverExecutedTime":3}
    //错误返回：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}
    
    /***********end*****************/
    
    
    
    
    /************删除打印机*************/
    
    // 打印机编号，多台打印机请用减号"-"连接起来。
    $snlist = "316500010-316500011";
//    $response  = $f->delPrinter($snlist);
    
    //正确返回： {"ok":["800000777成功","915500104成功"],"no":["800000777用户UID不匹配"]}
    //错误返回：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}
    /***********end*****************/
    
    
    
    /************打印订单*************/
    
    //标签说明：
    //单标签:
    //"<BR>"为换行,"<CUT>"为切刀指令(主动切纸,仅限切刀打印机使用才有效果)
    //"<LOGO>"为打印LOGO指令(前提是预先在机器内置LOGO图片),"<PLUGIN>"为钱箱或者外置音响指令
    //成对标签：
    //"<CB></CB>"为居中放大一倍,"<B></B>"为放大一倍,"<C></C>"为居中,<L></L>字体变高一倍
    //<W></W>字体变宽一倍,"<QR></QR>"为二维码,"<BOLD></BOLD>"为字体加粗,"<RIGHT></RIGHT>"为右对齐
    
    //拼凑订单内容时可参考如下格式
    //根据打印纸张的宽度，自行调整内容的格式，可参考下面的样例格式
    $content = '<CB>测试打印</CB><BR>';
    $content .= '名称　　　　　 单价  数量 金额<BR>';
    $content .= '--------------------------------<BR>';
    $content .= '饭　　　　　 　10.0   10  100.0<BR>';
    $content .= '炒饭　　　　　 10.0   10  100.0<BR>';
    $content .= '蛋炒饭　　　　 10.0   10  100.0<BR>';
    $content .= '鸡蛋炒饭　　　 10.0   10  100.0<BR>';
    $content .= '西红柿炒饭　　 10.0   10  100.0<BR>';
    $content .= '西红柿蛋炒饭　 10.0   10  100.0<BR>';
    $content .= '西红柿鸡蛋炒饭 10.0   10  100.0<BR>';
    $content .= '--------------------------------<BR>';
    $content .= '备注：加辣<BR>';
    $content .= '合计：xx.0元<BR>';
    $content .= '送货地点：广州市南沙区xx路xx号<BR>';
    $content .= '联系电话：13888888888888<BR>';
    $content .= '订餐时间：2014-08-08 08:08:08<BR>';
    $content .= '<QR>http://www.feieyun.com</QR>';//把二维码字符串用标签套上即可自动生成二维码
    
    //$sn => 打印机编号
    //$content => 打印内容,不能超过5000字节
    //$times => 打印次数，默认为1。
    $response  = $f->printMsg($sn,$content,1);//该接口只能是小票机使用,如购买的是标签机请使用下面方法3，调用打印
    //正确返回： {"ok":["800000777成功","915500104成功"],"no":["800000777用户UID不匹配"]}
    //错误返回：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}
    /***********end*****************/
    
    
    
    /************标签机打印订单*************/
    
    //标签说明：
    $content = "<DIRECTION>1</DIRECTION>";//设定打印时出纸和打印字体的方向，n 0 或 1，每次设备重启后都会初始化为 0 值设置，1：正向出纸，0：反向出纸，
    $content .= "<TEXT x='9' y='10' font='12' w='1' h='2' r='0'>#001       五号桌      1/3</TEXT><TEXT x='80' y='80' font='12' w='2' h='2' r='0'>可乐鸡翅</TEXT><TEXT x='9' y='180' font='12' w='1' h='1' r='0'>张三先生       13800138000</TEXT>";//40mm宽度标签纸打印例子
    
    //提示：
    //$sn => 打印机编号
    //$content => 打印内容,不能超过5000字节
    //$times => 打印次数，默认为1。
//     $response  = $f->printLabelMsg($sn,$content,1);//该接口只能是标签机使用，其它型号打印机请勿使用该接口
    
    /***********end*****************/
    
    
    
    /**************查询订单是否打印成功***********************/
    
    //$orderid => 订单ID，由方法1接口Open_printMsg返回。
    //打开注释可测试
    $orderid = "123456789_20160823165104_1853029628";//订单ID，从方法1返回值中获取
//    $response = $f->orderState($orderid);
    
    /***********end*****************/
    
    
    /**************获取某台打印机状态*************************/
    //***接口返回值说明***
    //正确例子：
    //{"msg":"ok","ret":0,"data":"离线","serverExecutedTime":9}
    //{"msg":"ok","ret":0,"data":"在线，工作状态正常","serverExecutedTime":9}
    //{"msg":"ok","ret":0,"data":"在线，工作状态不正常","serverExecutedTime":9}
    
    //提示：
    //$sn => 填打印机编号
    // queryPrinterStatus(SN);
    $sn = "316500010";//订单ID，从方法1返回值中获取
    $response = $f->printerStatus($sn);
    /***********end*****************/


 

    