<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

$redis = new \Lib\RedisAPI();

$pkey = 'quality';
$feildKey = '';

/**
 * 初始化数据结构
 */
$list = array(
    'shop1' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop2' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop3' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop4' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop5' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop6' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop7' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),'shop8' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),'shop9' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
    'shop10' => array(
        '20170513' => 20,
        '20170514' => 20,
    ),
);

//todo 递归
foreach ($list as $sk => $sv) {
    foreach ($sv as $dk => $dv) {
        $feildKey = $sk . ':' . $dk;
        $redis->hSet($pkey, $feildKey, $dv);
    }
}
if($redis->hGet($pkey, $feildKey)) {
    echo pirntData(1, 'create success');
}else {
    echo pirntData(1, 'create fail');
}

function pirntData($status, $msg){
    return json_encode(array($status, $msg), 1);
}

exit;
