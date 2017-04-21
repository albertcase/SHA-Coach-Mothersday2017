<?php
error_reporting(0);
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

$redis = new \Lib\RedisAPI();

$pkey = 'quality';

$feild = $argv[1];
$num = $argv[2];

if($feild == '') {
    echo pirntData(0, 'feild null');
}

if($num == '') {
    echo pirntData(0, 'num null');
}

$redis->hSet($pkey, $feild, $num);

if($redis->hGet($pkey, $feild)) {
    echo pirntData(1, 'update success');
}

function pirntData($status, $msg){
    return json_encode(array($status, $msg), 1);
}

exit;
