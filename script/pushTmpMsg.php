<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

$date = $argv[1];
$db = new \Lib\DatabaseAPI();
$applylist = getApplyList($db, $date);

var_dump($applylist);exit;

foreach ($applylist as $v){
    sendMessage($v);
    pushLog($v);
    updateStatus($v['pid']);
}
//$data = array(
//    'openid' => 'oKCDxjs3Pi4XDVv4Y9_CGI3tu33o',
//    'name' => 'anke'
//);

/**
 * send template msg
 */
function sendMessage($data) {
    $data = array(
        'touser' => $data['openid'],
        'template_id' => 'WndD3kOmw-_OvtTPg0yfs0qziEWoHirCnsyXF8IiPns',
        'url' => '',
        'topcolor' => '#000000',
        'data' => array(
            'first' => array(
                'value' => "尊敬的客人,\n您预约的COACH母亲节线下活动即将开始。\n",
                'color' => '#000000'
            ),
            'keyword1' => array(
                'value' => $data['name'],
                'color' => '#000000'
            ),
            'keyword2' => array(
                'value' => date('Y-m-d'),
                'color' => '#000000'
            ),
            'remark' => array(
                'value' => "地址：上海淮海中路282号香港广场店\n\n欢迎您前往预约的COACH上海香港广场店享受欢乐母亲节时光。",
                'color' => '#000000'
            )

        )
    );
    $api_url = "http://coach.samesamechina.com/v2/wx/template/send?access_token=" . CURIO_TOKEN;
    $rs = postData($api_url, $data);
    return $rs;
}

/**
 * post data
 */
function postData($api_url, $data) {
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $api_url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
    $return = curl_exec ( $ch );
    return $return;
    curl_close ( $ch );
}

/**
 * 获取要推送的数据
 * @param date: 20170501 提前一天推送
 */
function getApplyList($db, $date)  {
    return $db->getApplyList($date);
}

/**
 * 记录消息推送日志
 */
function pushLog($data) {

}

/**
 * 修改线下预约数据的状态
 */
function updateStatus($applyId) {

}