<?php
    
    
    namespace Cblink\FeieyunSdk;
    
    
    use Cblink\FeieyunSdk\Exceptions\InvalidArgumentException;
    use GuzzleHttp\Client;
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\RedirectMiddleware;

    class HttpClient
    {
        private $guzzleOptions = [];
        private $url = 'http://api.feieyun.cn/Api/Open/ ';
        private $config;
    
        /**
         * @param  [array] $config
         * @throws InvalidArgumentException
         */
        public function __construct(array $config = [])
        {
            if (!isset($config['user'])) {
                throw new InvalidArgumentException('params user is necessary');
            }
    
            if (!isset($config['ukey'])) {
                throw new InvalidArgumentException('params ukey is necessary');
            }
            
            if (isset($config['timeout'])) {
                $this->guzzleOptions['timeout'] = $config['timeout'];
            }
            
            $this->configureDefaults($config);
        }
        
        public function getHttpClient()
        {
            return new Client($this->guzzleOptions);
        }
        
        public function setGuzzleOptions(array $options)
        {
            $this->guzzleOptions = $options;
        }
    
        protected function toolFunction(array $data)
        {
            $time = time();
            $param = [
                'user' => $this->config['user'],
                'stime' => $time,
                'sig' => $this->signature($time),
            ];
            $params = $param + $data;
            $response = $this->getHttpClient()->request('POST', $this->url,[
                'form_params' => $params
            ])->getBody()->getContents();
    
            return $response;
        }
        /**
         * [批量添加打印机接口 Open_printerAddlist]
         * @param  [string] $printerContent [打印机的sn#key]
         * @return [string]        [接口返回值]
         * */
        public function addPrinter($printerContent)
        {
            $params = array_filter([
                'apiname' => 'Open_printerAddlist',
                'printerContent'=> $printerContent
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [批量删除打印机 Open_printerDelList]
         * @param  [string] $snlist        [打印机编号，多台打印机请用减号“-”连接起来]
         * @return [string]       [接口返回值]
         */
        function delPrinter($snlist){
            $params = array_filter([
                'apiname' => 'Open_printerDelList',
                'printerContent'=> $snlist
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [获取某台打印机状态接口 Open_queryPrinterStatus]
         * @param  [string] $sn [打印机编号]
         * @return [string]     [接口返回值]
         */
        function printerStatus($sn){
            $params = array_filter([
                'apiname' => 'Open_queryPrinterStatus',
                'sn'=>$sn
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [查询订单是否打印成功接口 Open_queryOrderState]
         * @param  [string] $orderid [调用打印机接口成功后,服务器返回的JSON中的编号 例如：123456789_20190919163739_95385649]
         * @return [string]          [接口返回值]
         */
        function orderState($orderid){
            $params = array_filter([
                'apiname'=>'Open_queryOrderState',
                'orderid'=>$orderid
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [打印订单接口 Open_printMsg]
         * @param  [string] $sn      [打印机编号sn]
         * @param  [string] $content [打印内容]
         * @param  [string] $times   [打印联数]
         * @return [string]          [接口返回值]
         */
        function printMsg($sn,$content,$times){
            $params = array_filter([
                'apiname'=>'Open_printMsg',
                'sn'=>$sn,
                'content'=>$content,
                'times'=>$times//打印次数
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [标签机打印订单接口 Open_printLabelMsg]
         * @param  [string] $sn      [打印机编号sn]
         * @param  [string] $content [打印内容]
         * @param  [string] $times   [打印联数]
         * @return [string]          [接口返回值]
         */
        function printLabelMsg($sn,$content,$times){
            $params = array_filter([
                'apiname'=>'Open_printLabelMsg',
                'sn'=>$sn,
                'content'=>$content,
                'times'=>$times//打印次数
            ]);
            return $this->toolFunction($params);
        }
    
    
        /**
         * [signature 生成签名]
         * @param  [string] $time [当前UNIX时间戳，10位，精确到秒]
         * @return [string]       [接口返回值]
         */
        private function signature($time){
            return sha1($this->config['user'].$this->config['ukey'].$time);//公共参数，请求公钥
        }
    
        private function configureDefaults(array $config)
        {
            $defaults = [
            
            ];
            
            $this->config = $config + $defaults;
        }
    }