<?php

namespace App\Handlers;


use QL\QueryList;

class Crawler
{
    public function DigFeixiaohao($coinCode)
    {
        if($coinCode !== ''){
       //采集目标
       $url = 'https://m.feixiaohao.com/currencies/'.$coinCode;
       // 图表api http://mapi.feixiaohao.com/api/coin/coinhisdata/?coinCode=eos&beginTime=1514739661000&&endTime=1514749661000
       
       //编写采集规则
       $rules = array(
            //币种名称
            'coinName' => array('.boxTit.coin-tit>h1','text','-small'),
            // 币种代码
            'coinCode' => array('.boxTit.coin-tit>h1>small','text'),
            // 币价
            'coinPrice' => array('.price1>.main','text','-i -.range-info'),
            //币价日同比
            'range' => array('.price1>.main>.range-info>text-red','text'),
            // 币价对美元
            'againstUSD' => array('.lowheight>div:eq(0)>span','text'),
            // 24小时最高价
            'heigth24H' =>  array('.lowheight>div:eq(1)>span','text'),
            // 24小时最低价
            'low24H' => array('.lowheight>div:eq(2)>span','text'),
            //24小时成交额
            'volume' => array('.lowheight>div:eq(3)>span','text'),
            // 24小时换手率
            'turnoverRate' => array('.lowheight>div:eq(4)>span','text'),
            //流通市值
            'marketValue' => array('.box:eq(3)>.mainInfo:eq(1)>.leftside>.val','text'),   
            //流通量
            'turnover' => array('.mainInfo2>.leftside>.val:eq(0)','text'),
            //发行量
            'distribution' => array('.mainInfo2>.leftside>.val:eq(1)','text')
       );

         $ql = QueryList::get($url)->rules($rules)->query()->getData();
       
       return   $ql->all();
    }
    else
        return ;

    }
}