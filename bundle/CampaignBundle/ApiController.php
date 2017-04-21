<?php
namespace CampaignBundle;

use Core\Controller;


class ApiController extends Controller {

    public function __construct() {

    	global $user;

        parent::__construct();

        if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        }
    }

    /**
     * 获取场次列表
     */
    public function getApplyListAction() {

    }


    /**
     * 预约
     * 1.判定用户是否登录
     * 2.验证字段
     * 3.检查所选场次是否有名额
     * 4.判断用户预约状态是否正确
     */
    public function inCreateApplyAction() {

        global $user;

        $request = $this->request;
        $fields = array(
            'name' => array('notnull', '1001', 'name is null'),
            'tel' => array('cellphone', '1002', 'tel is failed'),
            'shop' => array('notnull', '1003', 'shop is null'),
            'date' => array('notnull', '1004', 'date is null'),
        );
        $request->validation($fields);

        $searchData = array($request->request->get('shop'), $request->request->get('date'));
        $searchKey = $this->convertKey($searchData);

        if(!$this->getCountNum($searchKey)) {
            $this->statusPrint('1005', 'count failed');
        }

        if(!$this->checkUserStatus($user->uid)) {
            $this->statusPrint('1006', 'user status failed');
        }

        $db = new \Lib\DatabaseAPI();
        $applyInfo = new \stdClass();
        $applyInfo->uid = $user->uid;
        $applyInfo->name = $request->request->get('name');
        $applyInfo->tel = $request->request->get('tel');
        $applyInfo->shop = $request->request->get('shop');
        $applyInfo->date = $request->request->get('date');

        if(!$db->insertApply($applyInfo)) {
            $this->statusPrint('1007', 'insert failed');
        }

        if(!$this->inCreateCountNum($searchKey)) {
            $this->statusPrint('1008', 'apply failed');
        }

        $this->statusPrint('2000', 'apply success');

    }

    /**
     * 用户预约状态判断
     * @param uid  用户id
     * @param type login:登录状态 apply:预约状态
     * @return boolean
     */
    private function checkUserStatus($uid) {

        global $user;

        $db = new \Lib\DatabaseAPI();

        if(empty($db->findApplyByUid($user->uid))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取预约剩余预约名额
     */
    private function getCountNum($key) {
        $redis = new \Lib\RedisAPI();
        if($redis->hGet('count', $key) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 写入预约剩余名额
     */
    private function inCreateCountNum($key, $num = -1) {
        $redis = new \Lib\RedisAPI();
        if(!$redis->hInCrby('count', $key, $num)) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * 场次键值的转换
     * @param type ['array'=>'列表转换成redis的key值', 'string'=>'redis的key值转换为列表'] 默认array
     */
    private function convertKey($data , $type = 'array') {
        if($type = 'array') {
            $data = (array) $data;
            return implode(':', $data);
        } elseif($type = 'string') {
            $data = (string) $data;
            return explode(':', $data);
        }
    }


}
