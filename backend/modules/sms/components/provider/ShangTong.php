<?php

Yii::import('application.modules.sms.components.HttpClient');

class ShangTong {
	
	//接口网站地址
	const WEBSITE = '';
	const SEND_URL = 'http://210.22.13.101:8686/http/timeSender';
	const BALANCE_URL = 'http://219.133.59.215:8686/http/getBalance';
	const RECEIVE_URL = '';
	
	public $_parameters = array();
		
	function __construct() {		
	}
	
	public function send($username, $password, $message, $tonumbers, $time,$parameters='') {
		if(!is_array($tonumbers)) {
			$tonumbers = array($tonumbers);
		}
		date_default_timezone_set('Asia/Shanghai');

		/*if(!empty($parameters)){
			$paramArr = json_decode($parameters);
			if(is_array($paramArr)){
				foreach($paramArr as $key=>$val){//只支持一维数组,多个属性
					$sendArr[$key]=$val;
				}
			}
		}*/
		$response = HttpClient::quickGet(self::SEND_URL,array(
			'enterpriseid' => urlencode($username),
			'pswd' => $password,
			'period'   => 3,
			'mobs' => implode(';', $tonumbers),
			'msg' =>  urlencode($message),
			'task' => microtime(1),
			'day' => $time ? substr($time, 0, 10) : date('Y-m-d'),
			'sendHour' => $time ? substr($time, 11, 2) : date('H'),
			'sendMinute' => $time ? substr($time, 14, 2) : date('i'),
		));
		switch($response){
			case 100:
				$success   = true;
				$err_msg = '发送成功';
				break;
			case 802:
				$success   = false;
				$err_msg = '用户信息错';
				break;
			case 812:
				$success   = false;
				$err_msg = '发送失败';
				break;
			case 813:
				$success   = true;
				$err_msg = '其他错误';
				break;
			case 815:
				$success   = false;
				$err_msg = '短信内容为空';
				break;
			case 816:
				$success   = false;
				$err_msg = '日期参数错误';
				break;
			default:
				$success   = false;
				$err_msg = $response;
				break;
		}

		foreach($tonumbers as $phone){
			$result[] = array('success'=>$success, 'mobile'=>$phone,'return_msg'=>$err_msg);
		}
		
		return $result;
	}
	
	public function getBalance($username, $password,$parameters=''){
		$response = HttpClient::quickGet(self::BALANCE_URL,array(
			'userID' => $username,
			'pwd' => $password
		));
		
		return $response;
	}
	
}
?>
