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
    public function formAction() {
        $this->render('form');
    }

    /**
     * 上传图片
     */
    public function createAction() {
        $this->render('create');
    }

    /**
     * 积赞
     * 1.array [pid, nickname, role:1(自己) 0:(好友), num:点赞数, pic:作品图品, ispraise:0(未点赞) 1(已点赞)]
     */
    public function resultAction() {
        global $user;
        $db = new \Lib\DatabaseAPI();
        $pid = $_GET['pid'];
        $role = 0;
        $ispraise = 0;
        $photoinfo = $db->findPhotoByPid($pid);
        $nickname = $db->findUserByUid($photoinfo->uid)->nickname;//昵称
        if($this->checkPhotoUser($pid, $user->uid)) {
            $role = 1;
        }

        if($pid == $db->findPraiseByUid($user->uid)) {
            $ispraise = 1;
        }

        if($role ==1) {
            $ispraise = 1;
        }
        $list = array(
            'pid' => $pid,
            'name' => empty($nickname) ? 'Coach' : $nickname,
            'role' => $role,
            'num' => $photoinfo->num,
            'pic' => $photoinfo->pic,
            'ispraise' => $ispraise,
        );

            var_dump($list);exit;
        $this->render('result', array('list' => $list));
    }

    /**
     * 获取积赞榜
     * 1.array [name, pic ,num]
     */
    public function topTenAction() {
        $list = $this->getTopTen();
        $this->render('topten', array('list' => $list));
    }

    /**
     * 判断是否参加页面
     * 1.判断用户是否上传过作品
     * 2.如果上传过直接跳转到result页面。如果没有则跳转到上传图片页面！
     */
    public function checkPhotoAction() {
        global $user;
        $create_url = 'http://' . $_SERVER['HTTP_HOST'] . '/create';
        $result_url = 'http://' . $_SERVER['HTTP_HOST'] . '/result';

        if($this->getUserPhotoStatus($user->uid)) {
            $this->redirect($result_url . '?pid=' . $this->getUserPhotoStatus($user->uid));
        } else {
            $this->redirect($create_url);
        }
    }

    /**
     * 获取积赞榜单前十名
     */
    private function getTopTen() {
        $db = new \Lib\DatabaseAPI();
        return $db->findPraiseTopTen();
    }

    /**
     * 查看当前用户是否已经添加过作品
     */
    private function getUserPhotoStatus($uid) {
        $db = new \Lib\DatabaseAPI();
        return $db->findPhotoByUid($uid);
    }

    /**
     * 判断当前作品是否是当前用户
     */
    private function checkPhotoUser($pid, $uid) {
        $db = new \Lib\DatabaseAPI();
        $p = $db->findPhotoByUid($uid);
        if($p == $pid) {
            return true;
        } else {
            return false;
        }
    }

}