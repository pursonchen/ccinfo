<?php

namespace App\Handlers;

use GuzzleHttp\Client;

class CrawlerChart
{
    public function DigFeixiaohaoChart($coinCode, $beginTime, $endTime)
    {
      if($coinCode !== '' &&  $beginTime !== '' && $endTime !== '') {

      // 实例化 HTTP 客户端
      $http = new Client;

      $api = 'http://mapi.feixiaohao.com/api/coin/coinhisdata/';
    
      // 构建请求参数
        $query = http_build_query([
            "coinCode"     =>  $coinCode,
            "beginTime"  => $beginTime,
            "endTime"    => $endTime
        ]);

       // 发送 HTTP Get 请求
        $response = $http->get($api.$query);

      }
      else 
        return ;


    }
}