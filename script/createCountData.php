<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

$db = new \Lib\DatabaseAPI();
$redis = new \Lib\RedisAPI();

$pkey = 'count';
//店
$shop = array(
    'shop1',
    'shop2',
    'shop3',
    'shop4',
    'shop5',
    'shop6',
    'shop7',
    'shop8',
    'shop9',
    'shop10'
);

//日期
$date = array(
    '20170501am',
    '20170501pm',
    '20170502am',
    '20170502pm'
);

//名额数
$count = 10;

//生成场次
foreach ($shop as $sv) {
    foreach ($date as $dv) {
        $feildKey = $sv . ':' . $dv;
        $redis->hSet($pkey, $feildKey, $count);
    }
}




