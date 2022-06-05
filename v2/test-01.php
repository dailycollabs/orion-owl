<?php

session_start();

if (!isset($_SESSION['s'])) {
    $_SESSION['s'] = microtime();
}

$data = array(
    'key1'=>'value1',
    'key2'=>$_SESSION['s']);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);