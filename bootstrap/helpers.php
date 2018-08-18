<?php

//返回毫秒时间戳
function timestamp_now_ms()
{
    return (int)(microtime(true)*1000);
}

//字符串截取
//$str 需要截取的字符串
//$sing 截取的字符
//$number 返回截取的部分0 开始
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}


