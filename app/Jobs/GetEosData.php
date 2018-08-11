<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Handlers\Crawler;
use App\Handlers\CrawlerChart;

use Redis;


class GetEosData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $coinCode, $beginTime, $endTime;

    /**
     * Create a new job instance.
     * $coinCode    String   货币代码eos
     * $beginTime   String   数据开始时间 时间戳ms
     * $endTime
     * @return void
     */
    public function __construct($beginTime = '1533661261000', $endTime = '1533661461000')
    {
        $this -> coinCode = 'eos';
        $this -> beginTime = $beginTime;
        $this -> endTime = $endTime;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //请求EOS价格等基础数据 $c[0]['coinName']
        $basicInfo = app(Crawler::class)->DigFeixiaohao($this->coinCode);
        
        //缓存EOS基础信息
        Redis::set('basicInfo', json_encode($basicInfo[0],true));
        
        // 请求EOS价格图表
        $priceChart = app(CrawlerChart::class)->DigFeixiaohaoChart($this->coinCode, $this -> beginTime,$this -> endTime);
        
        //缓存EOS图表
        Redis::set('priceChart', json_encode($priceChart,true));
     
        
    }
}
