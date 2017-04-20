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
		$nickname = $userinfo->nickname ? $userinfo->nickname : '';
		$sex = $userinfo->sex ? $userinfo->sex : '';
		$city = $userinfo->city ? $userinfo->city : '';
		$province = $userinfo->province ? $userinfo->province : '';
		$country = $userinfo->country ? $userinfo->country : '';
		$headimgurl = $userinfo->headimgurl ? $userinfo->headimgurl : '';
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

}
