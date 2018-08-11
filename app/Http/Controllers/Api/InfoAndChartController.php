<?php

namespace App\Http\Controllers\Api;

use App\Handlers\Crawler;
use App\Handlers\CrawlerChart;
use Illuminate\Http\Request;
use App\Jobs\GetEosData;

use Redis;

class InfoAndChartController extends Controller
{
    public function asyncshow()
    {
         $h24 = 86400000;
         $beginTime = timestamp_now_ms() - $h24;
         $endTime = timestamp_now_ms();

         dispatch(new GetEosData($beginTime, $endTime));

    }    

    public function show()
    {

         $h24 = 86400000;
         $beginTime = timestamp_now_ms() - $h24;
         $endTime = timestamp_now_ms();


        //请求EOS价格等基础数据 $c[0]['coinName']
        $basicInfo = app(Crawler::class)->DigFeixiaohao('eos');
        
        
        //请求EOS价格图表
        $priceChart = app(CrawlerChart::class)->DigFeixiaohaoChart('eos', $beginTime, $endTime);
        
         return json_encode(array_merge($basicInfo[0], $priceChart), true);

    }

    

}
