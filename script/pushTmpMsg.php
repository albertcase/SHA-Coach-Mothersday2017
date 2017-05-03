<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

error_reporting(0);

$date = $argv[1];//推送的日期
$db = new \Lib\DatabaseAPI();
$applylist = getApplyList($db, $date);
$msg = '';

foreach ($applylist as $v){
    sendMessage($v);
    pushLog($db, $v);
    updateStatus($db, $v);
    if(pushLog($db, $v) && updateStatus($db, $v)) {
        $msg = 'push success';
    } else {
        $msg = 'push failed';
    }
    tailLog($v['openid'], $msg);
}

/**
 * send template msg
 */
function sendMessage($senddata) {
    $data = array(
        'touser' => $senddata['openid'],
        'template_id' => 'WndD3kOmw-_OvtTPg0yfs0qziEWoHirCnsyXF8IiPns',
        'url' => '',
        'topcolor' => '#000000',
        'data' => array(
            'first' => array(
                'value' => "尊敬的客人,\n您预约的COACH母亲节线下活动即将开始。\n",
                'color' => '#000000'
            ),
            'keyword1' => array(
                'value' => $senddata['name'],
                'color' => '#000000'
            ),
            'keyword2' => array(
                'value' => $senddata['created'],
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
function pushLog($db, $data) {
    $loginfo = new \stdClass();
    $loginfo->apply_id = $data['id'];
    $loginfo->openid = $data['openid'];
    $loginfo->name = $data['name'];
    $loginfo->status = 1;
    return $db->insertPushLog($loginfo);
}

/**
 * 修改线下预约数据的状态
 */
function updateStatus($db, $data) {
    return $db->updateApplyStatus($data['id']);
}

/**
 * 推送状态log
 */
function tailLog($openid, $result) {
    file_put_contents("pushlog.txt", $openid . ' ' . $result, FILE_APPEND);
}