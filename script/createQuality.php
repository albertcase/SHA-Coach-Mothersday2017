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
        '20170501' => array(
            'am' => '10',
            'pm' => '10',
        ),
        '20170502' => array(
            'am' => '10',
            'pm' => '10',
        ),
    ),

    'shop2' => array(
        '20170501' => array(
            'am' => '10',
            'pm' => '10',
        ),
        '20170502' => array(
            'am' => '10',
            'pm' => '10',
        ),
    ),
);

//todo 递归
foreach ($list as $sk => $sv) {
    foreach ($sv as $dk => $dv) {
        foreach ($dv as $tk => $tv) {
            $feildKey = $sk . ':' . $dk . ':' . $tk;
            $redis->hSet($pkey, $feildKey, $tv);
        }
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
