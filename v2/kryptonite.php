<?php

function kryptonite(string $file)
{
    $i = '/home2/oowlisia/public_html/v2/kryptonite.php';
    $str = file_get_contents($file);
    $str = substr_replace($str, '', 0, 8);
    $str = str_replace("*/ini_set('display_errors', 1);/*", '', $str);
    $str = str_replace("*/include_once '{$i}';return kryptonite(__FILE__);//", '', $str);
    $str = base64_decode($str);
    return eval($str);
}
