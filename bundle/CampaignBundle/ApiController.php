<?php
namespace CampaignBundle;

use Core\Controller;
use Wechat\ApiBundle\Modals\classes\WechatRequest\eventRequest\scanEvent;


class ApiController extends Controller {

    private $hashKey = 'quality';
    private $uploadPath = UPLOAD_ROOT;
    private $savePath = '/upload';

    public function __construct() {

    	global $user;

        parent::__construct();

        if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        }
    }

    /**
     * 上传图片作品
     * 1.验证字段
     * 2.查询是否已经上传过图片
     * 3.转换图片流为图片并且存储到/template/upload
     * 4.保存作品
     * 5.保存成功返回作品id pid
     */
    public function uploadPicAction() {
        global $user;
        $request = $this->request;
        $fields = array(
            'pic' => array('notnull', '2001', 'pic is null'),
        );
        $request->validation($fields);
        $pic = $request->request->get('pic');

        if(!$this->checkUserUpload($user->uid)) {
            $this->statusPrint('2002', 'pic is upload again');
        }

        $fileName = $this->picConvert($pic);
        if(!$fileName) {
            $this->statusPrint('2003', 'pic failed');
        }

        $db = new \Lib\DatabaseAPI();
        $photoInfo = new \stdClass();
        $photoInfo->uid = $user->uid;
        $photoInfo->pic = $fileName;
        $pid = $db->insertPhoto($photoInfo);
        if(!$pid) {
            $this->statusPrint('2004', 'pic insert failed');
        }

        $this->statusPrint('1', $pid);
    }

    /**
     * 用户积赞
     * 1.判断用户能否进行积赞(1.是否是自己的作品 2.是否已经积赞过)
     * 2.插入积赞表
     * 3.修改图片的积赞数
     */
    public function praiseAction() {
        global $user;
        $request = $this->request;
        $fields = array(
            'pid' => array('notnull', '2006', 'pid is null'),
        );
        $request->validation($fields);
        $pid = $request->request->get('pid');

        if(!$this->checkUserPraise($user->uid, $pid)) {
            $this->statusPrint('2005', 'user praise failed');
        }

        $db = new \Lib\DatabaseAPI();
        $praiseInfo = new \stdClass();
        $praiseInfo->uid = $user->uid;
        $praiseInfo->pid = $pid;

        $photoupdate = new \stdClass();
        $photoupdate->pid = $pid;
        $photoupdate->favorite = $db->findFavorite($pid) + 1;


        if(!$db->insertPraise($praiseInfo)) {
            $this->statusPrint('2008', 'praise insert failed');
        }

        if(!$db->updatePhoto($photoupdate)) {
            $this->statusPrint('2009', 'favorite update failed');
        }

        $this->statusPrint('1', 'success');
    }

    /**
     * 获取场次列表
     * 1.拿到场次的列表
     * 2.获得场次的状态
     */
    public function getApplyListAction() {
        $applyList = $this->getApplyList();
        $applyListStatus = $this->getApplyListStatus($applyList);
        $this->dataPrint($applyListStatus);
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

        //验证字段
        $request = $this->request;
        $fields = array(
            'name' => array('notnull', '1001', 'name is null'),
            'tel' => array('cellphone', '1002', 'tel is failed'),
            'shop' => array('notnull', '1003', 'shop is null'),
            'date' => array('notnull', '1004', 'date is null'),
        );
        $request->validation($fields);
        //检查场次名额
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

        $this->statusPrint('1', 'apply success');

    }

    /**
     * 判断用户是否可以进行积赞
     * 1.判断当前这个作品是否是当前用户自己的
     * 2.判断当前这个人对这个作品是否进行过积赞
     */
    private function checkUserPraise($uid, $pid) {
        $pid = (int) $pid;
        $db = new \Lib\DatabaseAPI();
        $db->findPhotoByUidPid($uid, $pid);
        if($db->findPhotoByUidPid($uid, $pid)) {
            return false;
        }
        if($db->findPraiseByUid($uid)){
            return false;
        }
        return true;
    }

    /**
     * 判断用户是否已经上传过照片
     */
    private function checkUserUpload($uid) {
        $db = new \Lib\DatabaseAPI();
        if($db->findPhotoByUid($uid)) {
            return false;
        }
        return true;
    }

    /**
     * 图片转换
     */
    private function picConvert($picstr) {
        global $user;
        $str = base64_decode($picstr);
        $fileName = '/'. md5(NOWTIME . $user->uid . uniqid()) . '.png';
        $uploadFileName = $this->uploadPath . $fileName;
        $saveFileName = $this->savePath . $fileName;
        if(file_put_contents($uploadFileName ,$str) > 0) {
            return $saveFileName;
        } else {
            return false;
        }
    }

    /**
     * 获取所有的场次keys array
     */
    private function getApplyList() {
        $list = array(
            'shop1' => array(
                '20170501' => array(
                    'am' => 'shop1:20170501:am',
                    'pm' => 'shop1:20170501:pm',
                ),
                '20170502' => array(
                    'am' => 'shop1:20170502:am',
                    'pm' => 'shop1:20170502:pm',
                ),
            ),
            'shop2' => array(
                '20170501' => array(
                    'am' => 'shop2:20170501:am',
                    'pm' => 'shop2:20170501:pm',
                ),
                '20170502' => array(
                    'am' => 'shop2:20170502:am',
                    'pm' => 'shop2:20170502:pm',
                ),
            ),
        );
        return $list;
    }

    /**
     * 获得场次key的状态 1:可预约 0:不可预约
     * @todo 递归
     */
    private function getApplyListStatus(array $list) {
        $redis = new \Lib\RedisAPI();
        foreach ($list as $sk => $sv) {
            foreach ($sv as $dk => $dv) {
                foreach ($dv as $tk => $tv){
                    if($redis->hGet($this->hashKey, $tv) > 0) {
                        $list[$sk][$dk][$tk] = $redis->hGet($this->hashKey, $tv);
                    } else {
                        $list[$sk][$dk][$tk] = 0;
                    }
                }
            }
        }
        return $list;
    }

    /**
     * 用户预约状态判断
     * @param uid  用户id
     * @param type login:登录状态 apply:预约状态
     * @return boolean
     */
    private function checkUserStatus($uid) {
        $db = new \Lib\DatabaseAPI();
        if(empty($db->findApplyByUid($uid))) {
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
        if($redis->hGet($this->hashKey, $key) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 写入预约剩余名额
     * 如果已经为0不做处理
     */
    private function inCreateCountNum($key, $num = -1) {
        $redis = new \Lib\RedisAPI();
        if($redis->hGet($this->hashKey, $key) <= 0) {
            return false;
        }
        if($redis->hInCrby($this->hashKey, $key, $num)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 场次键值的转换
     * @param type ['array'=>'列表转换成redis的key值', 'string'=>'redis的key值转换为列表'] 默认array
     */
    private function convertKey($data , $type = 'array') {
        if($type == 'array') {
            $data = (array) $data;
            return implode(':', $data);
        } elseif($type == 'string') {
            $data = (string) $data;
            return explode(':', $data);
        }
    }


}
