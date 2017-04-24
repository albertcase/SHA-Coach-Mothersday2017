<?php

$routers = array();
$routers['/wechat/oauth2'] = array('WechatBundle\Wechat', 'oauth');
$routers['/wechat/callback'] = array('WechatBundle\Wechat', 'callback');
$routers['/wechat/curio/callback'] = array('WechatBundle\Curio', 'callback');
$routers['/wechat/curio/receive'] = array('WechatBundle\Curio', 'receiveUserInfo');
$routers['/wechat/ws/jssdk/config/webservice'] = array('WechatBundle\WebService', 'jssdkConfigWebService');
$routers['/wechat/ws/jssdk/config/js'] = array('WechatBundle\WebService', 'jssdkConfigJs');
$routers['/ajax/post'] = array('CampaignBundle\Api', 'form');
$routers['/'] = array('CampaignBundle\Page', 'index');
$routers['/clear'] = array('CampaignBundle\Page', 'clearCookie');

//page
$routers['/apply'] = array('CampaignBundle\Page', 'apply');//预约授权
$routers['/collection'] = array('CampaignBundle\Page', 'collection');//集赞授权

//api
$routers['/api/apply'] = array('CampaignBundle\Api', 'inCreateApply');//预约
$routers['/api/applylist'] = array('CampaignBundle\Api', 'getApplyList');//获取场次列表
$routers['/api/uploadpic'] = array('CampaignBundle\Api', 'uploadPic');//上传头像
$routers['/api/praise'] = array('CampaignBundle\Api', 'praise');//用户积赞
$routers['/api/topTenList'] = array('CampaignBundle\Api', 'topTen');//积赞榜