<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";

//error_reporting(0);

$date = $argv[1];//推送的日期
$db = new \Lib\DatabaseAPI();
$applylist = getApplyList($db, $date);
$msg = '';

foreach ($applylist as $v){

    $userinfo = $db->findUserByUid($v['uid']);
    $openid = $v['openid'];
    $datearr = explode('/' , $v['date']);
    $date = $datearr['0'] . '年' . $datearr['1'] . '月' . $datearr['2'] . '日';
    $shopAdr = $db->findShopByShopid($v['shop'])->addr;
    $shopTime = '10:00 - 22:00';
    $name = $v['name'];
    $appid = $v['id'];

    //扬州店
    if($v['shop'] == 'shop1') {
        if($date  == '2017/05/13') {
            $shopTime = '09:00 - 22:30';
        } else {
            $shopTime = '09:00 - 22:00';
        }
    }

    //长春店
    if($v['shop'] == 'shop6') {
        $shopTime = '10:00 - 21:00';
    }

    //深圳店
    if($v['shop'] == 'shop7') {
        $shopTime = '10:00 - 22:30';
    }

    //乌鲁木齐店
    if($v['shop'] == 'shop8') {
        $shopTime = '11:00 - 21:00';
    }

    //大连店
    if($v['shop'] == 'shop9') {
        $shopTime = '09:00 - 21:30';
    }

    $pushData = array(
        'id' => $appid,
        'openid' => $openid,
        'name' => $name,
        'date' => $date,
        'addr' => $shopAdr,
        'time' => $shopTime,
    );

    $send = sendMessage($pushData);
    $push = pushLog($db, $pushData);
    $update = updateStatus($db, $pushData);

    if($send && $push && $update) {
        $msg = 'push success';
    } else {
        $msg = 'push failed';
    }
    tailLog($v['openid'], $msg);
}

/**
 * 发送模版消息
 * param ["openid":用户标识]
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
                'value' => $senddata['date'],
                'color' => '#000000'
            ),
            'remark' => array(
                'value' => "地址：" . $senddata['addr'] . "\n\n欢迎您在 " . $senddata['time'] . "持此份活动通知，参与活动与COACH一起共享母亲节温馨时刻",
                'color' => '#000000'
            )

        )
    );
    $api_url = "http://coach.samesamechina.com/v2/wx/template/send?access_token=" . CURIO_TOKEN;
    $rs = postData($api_url, $data);
    return $rs;
}

/**
 * 获取要推送的数据
 * @param date: 20170501 提前一天推送
 */
function getApplyList($db, $date)  {
    return $db->getApplyList($date);
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
 * 脚本日志
 */
function tailLog($openid, $result) {
-    file_put_contents("pushlog.txt", $openid . ' ' . $result . "\n", FILE_APPEND);
}