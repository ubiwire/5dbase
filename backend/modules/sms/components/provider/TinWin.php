<?php

Yii::import('application.modules.sms.components.HttpClient');

class TinWin {
	
	//接口网站地址
	const WEBSITE = '';
	const SEND_URL = 'http:// gateway.tinwin.com.cn/xunjiehttp/Submit';
	const BALANCE_URL = 'http://gateway.tinwin.com.cn/xunjiehttp/GetBlance?';
	const RECEIVE_URL = '';
	
	public $_parameters = array();
		
	function __construct() {		
	}
	
	public function send($username, $password, $message, $tonumbers, $time,$parameters='') {
		if(!is_array($tonumbers)) {
			$tonumbers = array($tonumbers);
		}
		if(!empty($parameters)){
			$paramArr = json_decode($parameters);//只支持一维数组,多个属性
			if(!is_array($paramArr))$paramArr=array();
		}
		date_default_timezone_set('Asia/Shanghai');
		$response = HttpClient::quickGet(self::SEND_URL,array(
			'userName' => urlencode($paramArr['CoreId'].":".$username),
			'password' => $password,
			'dest_Id' => implode(';', $tonumbers),
			'content' =>  urlencode($message),
			'sendTime' => $time,
		));
		switch($response){
			case 0:
				$success   = true;
				$err_msg = '发送成功';
				break;
			case -2:
				$success   = false;
				$err_msg = '用户信息错';
				break;
			case -1:
				$success   = false;
				$err_msg = '发送失败';
				break;
			case -4:
				$success   = true;
				$err_msg = '余额不足';
				break;
			case -5:
				$success   = false;
				$err_msg = '短信内容过长';
				break;
			case -6:
				$success   = false;
				$err_msg = '日期参数错误';
				break;
			case -7:
				$success = false;
				$err_msg = '非法手机号码';
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
		if(!empty($parameters)){
			$paramArr = json_decode($parameters);//只支持一维数组,多个属性
			if(!is_array($paramArr))$paramArr=array();
		}
		$response = HttpClient::quickGet(self::BALANCE_URL,array(
			'userName' => $paramArr['CoreId'].":".$username,
			'password' => $password
		));
		
		return $response;
	}
	
}
?>
