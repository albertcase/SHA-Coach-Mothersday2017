<?php

define("BASE_URL", 'http://127.0.0.1:9243/');
define("TEMPLATE_ROOT", dirname(__FILE__) . '/../template');
define("VENDOR_ROOT", dirname(__FILE__) . '/../vendor');
define("UPLOAD_ROOT", dirname(__FILE__) . '/../upload');

//User
define("USER_STORAGE", 'COOKIE');

//Wechat Vendor
define("WECHAT_VENDOR", 'curio'); // default | curio

//Wechat config info
define("TOKEN", '?????');
define("APPID", '?????');
define("APPSECRET", '?????');
define("NOWTIME", date('Y-m-d H:i:s'));
define("AHEADTIME", '100');

define("NONCESTR", '?????');
define("CURIO_TOKEN", 'zcBpBLWyAFy6xs3e7HeMPL9zWrd7Xy');
define("CURIO_AUTH_URL", 'http://coach.samesamechina.com/api/wechat/oauth/auth/e7a33b9c-c26e-41d0-88ec-14bf1a8ca4da');

//Redis config info
define("REDIS_HOST", '127.0.0.1');
define("REDIS_PORT", '6379');

//Database config info
define("DBHOST", '127.0.0.1');
define("DBUSER", 'root');
define("DBPASS", '');
define("DBNAME", 'coach-monthersday2017');

//Wechat Authorize
define("CALLBACK", 'wechat/callback');
define("SCOPE", 'snsapi_userinfo');

//Wechat Authorize Page
define("AUTHORIZE_URL", '[
	"/form",
	"/create",
	"/result",
	"/topten"
]');

//Account Access`
define("OAUTH_ACCESS", '{
	"xxxx": "samesamechina.com" 
}');
define("JSSDK_ACCESS", '{
	"xxxx": "samesamechina.com"
}');

define("ENCRYPT_KEY", '29FB77CB8E94B358');
define("ENCRYPT_IV", '6E4CAB2EAAF32E90');

define("WECHAT_TOKEN_PREFIX", 'wechat:token:');

