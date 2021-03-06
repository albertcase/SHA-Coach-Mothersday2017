<?php
namespace Lib;
/**
 * DatabaseAPI class
 */
class DatabaseAPI {

	private $db;

	private function connect() {
		$connect = new \mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		$this->db = $connect;
		$this->db->query('SET NAMES UTF8');
		return $this->db;
	}

	/**
	 * Create user in database
	 */
	public function insertUser($userinfo){
		$nowtime = NOWTIME;
		$nickname = isset($userinfo->nickname) ? $userinfo->nickname : '';
		$sex = isset($userinfo->sex) ? $userinfo->sex : '';
		$city = isset($userinfo->city) ? $userinfo->city : '';
		$province = isset($userinfo->province) ? $userinfo->province : '';
		$country = isset($userinfo->country) ? $userinfo->country : '';
		$headimgurl = isset($userinfo->headimgurl) ? $userinfo->headimgurl : '';
        $sql = "INSERT INTO `user` SET `openid` = ?, `nickname` = ?, `sex` = ?, `city` = ?, `province` = ?, `country` = ?, `headimgurl` = ?, `created` = ?, `updated` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("sssssssss", $userinfo->openid, $nickname, $sex, $city, $province, $country, $headimgurl, $nowtime, $nowtime);
		if($res->execute()) 
			return $this->findUserByOpenid($userinfo->openid);
		else 
			return FALSE;
	}

	public function updateUser($userinfo) {
        $userinfo = (object)$userinfo;
		if ($this->findUserByOpenid($userinfo->openid)) {
            $nowtime = NOWTIME;
            $sql = "UPDATE `user` SET `nickname` = ?, `sex` = ?, `city` = ?, `province` = ?, `country` = ?, `headimgurl` = ?, `created` = ?, `updated` = ? WHERE `openid` = ?";
            $res = $this->connect()->prepare($sql);
            $res->bind_param("sssssssss", $userinfo->nickname, $userinfo->sex, $userinfo->city, $userinfo->province, $userinfo->country, $userinfo->headimgurl, $nowtime, $nowtime, $userinfo->openid);
            if($res->execute())
                return $this->findUserByOpenid($userinfo->openid);
		}else{
            $this->insertUser($userinfo);
        }
	}

	public function findUserByOauth($openid) {
		$sql = "SELECT id  FROM `oauth` WHERE `openid` = ?"; 
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($uid);
		if($res->fetch()) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Create user in database
	 */
	public function findUserByOpenid($openid){
		$sql = "SELECT `uid`, `openid` FROM `user` WHERE `openid` = ?"; 
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($uid, $openid);
		if($res->fetch()) {
			$user = new \stdClass();
			$user->uid = $uid;
			$user->openid = $openid;
			return $user;
		}
		return NULL;
	}

	/**
	 * 
	 */
	public function saveInfo($data){
		if($this->findInfoByUid($data->uid)) {
			$this->updateInfo($data);
		} else {
			$this->insertInfo($data);
		}
	} 

	/**
	 * 
	 */
	public function insertInfo($data){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `info` SET `uid` = ?, `name` = ?, `cellphone` = ?, `address` = ?, `created` = ?, `updated` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("ssssss", $data->uid, $data->name, $data->cellphone, $data->address, $nowtime, $nowtime);
		if($res->execute()) 
			return $res->insert_id;
		else 
			return FALSE;
	}

	/**
	 * 
	 */
	public function updateInfo($data){
		$nowtime = NOWTIME;
		$sql = "UPDATE `info` SET `name` = ?, `cellphone` = ?, `address` = ?, `updated` = ? WHERE `uid` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("sssss", $data->name, $data->cellphone, $data->address, $nowtime, $data->uid);
		if($res->execute()) 
			return $this->findInfoByUid($data->uid);
		else 
			return FALSE;
	}

	/**
	 * Create user in database
	 */
	public function findInfoByUid($uid){
		$sql = "SELECT `id`, `name`, `cellphone`, `address` FROM `info` WHERE `uid` = ?";
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $uid);
		$res->execute();
		$res->bind_result($id, $name, $cellphone, $address);
		if($res->fetch()) {
			$info = new \stdClass();
			$info->id = $id;
			$info->name = $name;
			$info->cellphone = $cellphone;
			$info->$address = $address;
			return $info;
		}
		return NULL;
	}

	/**
     * Create apply in database
	 */
	public function insertApply($applyInfo) {
        $nowtime = NOWTIME;
	    $sql = "INSERT INTO `apply` SET `uid` = ?, `name` = ?, `tel` = ?, `shop` = ?, `date` = ?, `created` = ?";
	    $res = $this->connect()->prepare($sql);
        $res->bind_param("ssssss", $applyInfo->uid, $applyInfo->name, $applyInfo->tel, $applyInfo->shop, $applyInfo->date, $nowtime);
        if($res->execute())
            return $res->insert_id;
        else
            return FALSE;
    }

    /**
     * find apply in database
     */
    public function findApplyByUid($uid){
        $sql = "SELECT `id`, `name`, `tel`, `shop`, `date`, `created` FROM `apply` WHERE `uid` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $uid);
        $res->execute();
        $res->bind_result($id, $name, $tel, $shop, $date, $created);
        if($res->fetch()) {
            $apply = new \stdClass();
            $apply->id = $id;
            $apply->name = $name;
            $apply->tel = $tel;
            $apply->shop = $shop;
            $apply->date = $date;
            $apply->created = $created;
            return $apply;
        }
        return NULL;
    }

    /**
     * Create photo in database
     */
    public function insertPhoto($photoInfo) {
        $nowtime = NOWTIME;
        $sql = "INSERT INTO `photo` SET `uid` = ?, `pic` = ?, `created` = ?, `updated` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("ssss", $photoInfo->uid, $photoInfo->pic, $nowtime, $nowtime);
        if($res->execute())
            return $res->insert_id;
        else
            return FALSE;
    }

    /**
     * find photo in database
     */
    public function findPhotoByUid($uid){
        $sql = "SELECT `id` FROM `photo` WHERE `uid` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $uid);
        $res->execute();
        $res->bind_result($pid);
        if($res->fetch()) {
            return $pid;
        }
        return FALSE;
    }

    /**
     * find photo in database
     */
    public function findPhotoByUidPid($uid, $pid){
        $sql = "SELECT `created` FROM `photo` WHERE `uid` = ? AND `id` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("ss", $uid, $pid);
        $res->execute();
        if($res->fetch()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * find photo by pid in database
     */
    public function findPhotoByPid($pid){
        $sql = "SELECT `favorite`, `pic`, `uid` FROM `photo` WHERE `id` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $pid);
        $res->execute();
        $res->bind_result($num, $pic, $uid);
        if($res->fetch()) {
            $photoinfo =  new \stdClass();
            $photoinfo->num = $num;
            $photoinfo->pic = $pic;
            $photoinfo->uid = $uid;
            return $photoinfo;
        }
        return FALSE;
    }

    /**
     * find favorite in photo
     */
    public function findFavorite($pid) {
        $sql = "SELECT `favorite` FROM `photo` WHERE `id` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $pid);
        $res->execute();
        $res->bind_result($favorite);
        if($res->fetch()) {
            return $favorite;
        }
        return FALSE;
    }

    /**
     * update favorite in photo
     */
    public function updatePhoto($photoinfo) {
        $photoinfo = (object)$photoinfo;
        $nowtime = NOWTIME;
        $sql = "UPDATE `photo` SET `favorite` = ?, `updated` = ? WHERE `id` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("sss", $photoinfo->favorite, $nowtime, $photoinfo->pid);
        if($res->execute())
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Create praise in database
     */
    public function insertPraise($praiseInfo) {
        $nowtime = NOWTIME;
        $sql = "INSERT INTO `praise` SET `pid` = ?, `uid` = ?, `created` = ?, `updated` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("ssss", $praiseInfo->pid, $praiseInfo->uid, $nowtime, $nowtime);
        if($res->execute())
            return $res->insert_id;
        else
            return FALSE;
    }

    /**
     * find praise in database
     */
    public function findPraiseByUid($uid){
        $sql = "SELECT `pid` FROM `praise` WHERE `uid` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $uid);
        $res->execute();
        $res->bind_result($pid);
        if($res->fetch()) {
            return $pid;
        }
        return FALSE;
    }

    /**
     * find praise by uid and pid in database
     */
    public function findPraiseByUidPid($uid, $pid){
        $sql = "SELECT `pid` FROM `praise` WHERE `uid` = ? AND `pid` = ? ";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("ss", $uid, $pid);
        $res->execute();
        $res->bind_result($pid);
        if($res->fetch()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * find topten praise in database
     */
    public function findPraiseTopTen(){
        $sql = "SELECT p.`id`, u.`nickname`, p.`favorite`, p.`pic` FROM `photo` AS p, `user` AS u WHERE p.`uid` = u.`uid` ORDER BY p.`favorite` DESC, p.`created` LIMIT 0, 10";
        $res = $this->connect()->query($sql);
        $list = $res->fetch_all($resulttype = MYSQLI_ASSOC);
        if($list) {
            return $list;
        }
        return FALSE;
    }

    /**
     * find user by uid in database
     */
    public function findUserByUid($uid){
        $sql = "SELECT `uid`, `nickname`, `openid` FROM `user` WHERE `uid` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $uid);
        $res->execute();
        $res->bind_result($uid, $nickname, $openid);
        if($res->fetch()) {
            $user = new \stdClass();
            $user->uid = $uid;
            $user->nickname = $nickname;
            $user->openid = $openid;
            return $user;
        }
        return NULL;
    }

    /**
     * find apply in database
     */
    public function getApplyList($date) {
        $sql = "SELECT a.`id`, a.`name`, a.`uid`, a.`shop`, u.`openid`, a.`name`, a.`date`, a.`created` FROM `apply` AS a, `user` AS u WHERE a.`uid` = u.`uid` AND a.`date` = '" . $date . "' AND `status` = 0;";
        $res = $this->connect()->query($sql);
        $list = $res->fetch_all($resulttype = MYSQLI_ASSOC);
        if($list) {
            return $list;
        }
        return FALSE;
    }

    /**
     * insert pushlog in database
     */
    public function insertPushLog($loginfo) {
        $nowtime = NOWTIME;
        $sql = "INSERT INTO `pushlog` SET `apply_id` = ?, `openid` = ?, `name` = ?, `status` = ?, `created` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("sssss", $loginfo->apply_id, $loginfo->openid, $loginfo->name, $loginfo->status, $nowtime);
        if($res->execute())
            return $res->insert_id;
        else
            return FALSE;
    }

    /**
     * update apply status by applyid in database
     */
    public function updateApplyStatus($applyid) {
        $applyid = (int)$applyid;
        $status = 1;
        $sql = "UPDATE `apply` SET `status` = ? WHERE `id` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("ss", $status, $applyid);
        if($res->execute())
            return TRUE;
        else
            return FALSE;
    }

    /**
     * find shop by shopid in database
     */
    public function findShopByShopid($shopid){
        $sql = "SELECT `address` FROM `shop` WHERE `shopid` = ?";
        $res = $this->connect()->prepare($sql);
        $res->bind_param("s", $shopid);
        $res->execute();
        $res->bind_result($addr);
        if($res->fetch()) {
            $shop = new \stdClass();
            $shop->addr = $addr;
            return $shop;
        }
        return NULL;
    }

}
