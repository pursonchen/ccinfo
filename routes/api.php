<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {

     $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function($api) {

    // 获取基础数据
    $api->get('eosinfo', 'InfoAndChartController@show')
        ->name('api.infoAndChartController.show');

    //队列获取基础数据
    $api->get('async_eosinfo', 'InfoAndChartController@asyncshow')
        ->name('api.infoAndChartController.asyncshow');

    });
    
});

