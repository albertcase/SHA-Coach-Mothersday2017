<?php
namespace CampaignBundle;

use Core\Controller;


class ApiController extends Controller {

    public function __construct() {

    	global $user;

        parent::__construct();

//        if(!$user->uid) {
//	        $this->statusPrint('100', 'access deny!');
//        }
    }

    public function formAction() {

    	global $user;

    	$request = $this->request;
    	$fields = array(
			'name' => array('notnull', '120'),
			'cellphone' => array('cellphone', '121'),
			'address' => array('notnull', '122'),
		);
		$request->validation($fields);
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$data = new \stdClass();
		$data->uid = $user->uid;
		$data->name = $request->request->get('name');
		$data->cellphone = $request->request->get('cellphone');
		$data->address = $request->request->get('address');

		if($DatabaseAPI->insertInfo($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
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
            //如果没有名额返回错误
        }

        if(!$this->checkUserStatus($user->uid)) {
            //如果不符合预约用户返回错误
        }

        $db = new \Lib\DatabaseAPI();
        $applyInfo = new \stdClass();
        $applyInfo->uid = $user->uid;
        $applyInfo->name = $request->request->get('name');
        $applyInfo->tel = $request->request->get('tel');
        $applyInfo->shop = $request->request->get('shop');
        $applyInfo->date = $request->request->get('date');

        if(!$db->insertApply($applyInfo)) {
            $this->statusPrint('1005', 'insert failed');
        }

        if(!$this->inCreateCountNum($searchKey)) {
            $this->statusPrint('1006', 'apply failed');
        }

    }

    /**
     * 用户预约状态判断
     * @param uid  用户id
     * @param type login:登录状态 apply:预约状态
     * @return boolean
     */
    private function checkUserStatus($uid) {

    }

    /**
     * 获取预约剩余预约名额
     */
    private function getCountNum($key) {

    }


    /**
     * 写入预约剩余名额
     */
    private function inCreateCountNum($key) {

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
