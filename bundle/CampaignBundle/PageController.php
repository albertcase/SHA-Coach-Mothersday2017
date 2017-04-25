<?php
namespace CampaignBundle;

use Core\Controller;

class PageController extends Controller {

	public function indexAction() {
		$RedisAPI = new \Lib\RedisAPI();
		$config = $RedisAPI->jssdkConfig($this->request->getUrl(TRUE));
		$this->render('index', array('config' => $config));
	}

	public function clearCookieAction() {
		setcookie('_user', json_encode($user), time(), '/');
		$this->statusPrint('success');
	}

	/**
     * 预约
     */
    public function applyAction() {
        $this->render('offstore');
    }

    /**
     * 上传图片
     */
    public function collectionAction() {
        $this->render('create');
    }

    /**
     * 积赞
     * 1.传三个数据到页面 作品id 是否为本人的状态
     */
    public function praiseAction() {
        $this->render('result');
    }

    /**
     * 获取积赞榜 topten
     */
    public function topTenAction() {
        $list = $this->getTopTen();
        $this->render('topten', $list);
    }

    /**
     * 判断是否参加页面
     * 1.判断用户是否上传过作品
     * 2.如果上传过直接跳转到result页面。如果没有则跳转到上传图片页面！
     */
    public function checkPhotoAction() {

    }

    /**
     * 获取积赞榜单前十名
     */
    private function getTopTen() {

    }

}