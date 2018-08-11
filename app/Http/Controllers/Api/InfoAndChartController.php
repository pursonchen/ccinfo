<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Jobs\GetEosData;

use Redis;

class InfoAndChartController extends Controller
{
    public function show()
    {
         $h24 = 86400000;
         $beginTime = timestamp_now_ms() - $h24;
         $endTime = timestamp_now_ms();

         dispatch(new GetEosData($beginTime, $endTime));

    }
}
