<?php
require_once "./Core/bootstrap.php";
include_once "./config/config.php";
include_once "./config/router.php";


function sendMessage($openid) {
    $data = array(
        'touser' => $openid,
        'template_id' => 'WndD3kOmw-_OvtTPg0yfs0qziEWoHirCnsyXF8IiPns',
        'url' => '',
        'topcolor' => '#000000',
        'data' => array(
            'first' => array(
                'value' => '您参与的芝华士礼遇厚爱活动已审核。',
                'color' => '#000000'
            ),
            'keyword1' => array(
                'value' => '未通过',
                'color' => '#000000'
            ),
            'keyword2' => array(
                'value' => date('Y-m-d H:i:s'),
                'color' => '#000000'
            ),
            'remark' => array(
                'value' => '非常抱歉，您的小票不符合要求（不在活动时间之内/非芝华士20cl或70cl产品/小票不清晰/其他原因）建议您重新上传合格小票。',
                'color' => '#000000'
            )

        )
    );
    $api_url = "http://coach.samesamechina.com/v2/wx/template/send?access_token=" . CURIO_TOKEN;
    $rs = postData($api_url, $data);
    return $rs;
}

function postData($api_url, $data) {
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $api_url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
//    $return = curl_exec ( $ch );
    curl_close ( $ch );
}

//touser,template_id,first,keyword1,keyword2,remark,url,IGNORE_title,IGNORE_rawdata,IGNORE_tpl,IGNORE_last
//oKCDxjifM1kEMt1BY5O9NbYtz3rQ,WndD3kOmw-_OvtTPg0yfs0qziEWoHirCnsyXF8IiPns,"尊敬的客人，
//您预约的COACH母亲节线下活动即将开始。
//","Amber","2017年4月13日","地址：上海淮海中路282号香港广场店
//
//欢迎您前往预约的COACH上海香港广场店享受欢乐母亲节时光。","",,,,
