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
        $this->render('apply');
    }

    /**
     * 上传图片
     */
    public function collectionAction() {
        $this->render('create');
    }

    /**
     * 积赞
     */
    public function praiseAction() {
        $this->render('result');
    }
}