<?php

Yii::import('application.modules.sms.components.HttpClient');

class ZhongShang {
	
	//�ӿ���վ��ַ
	const WEBSITE = '';
	const SEND_URL = 'http://service.1681860.com/GbSe/SmsService.asmx/SendSms?';
	const BALANCE_URL = 'http://service.1681860.com/GbSe/SmsService.asmx/GetBalance?';
	const RECEIVE_URL = '';
    
    //$smsurl = 'http://service.1681860.com/GbSe/SmsService.asmx/SendSms?';
    //$smsuser = 'admin';
    //$smspwd = '21218cca77804d2ba1922c33e0151105';
    //$smsgroupid = '1007';
	
	public $_parameters = array();
		
	function __construct() {		
	}
	
	public function send($username, $password, $message, $tonumbers, $time,$parameters='') {
		if(!is_array($tonumbers)) {
			$tonumbers = array($tonumbers);
		}
		if(!empty($parameters)){
			$paramArr = json_decode($parameters);//ֻ֧��һά����,�������
			if(!is_array($paramArr))$paramArr=array();
		}
		date_default_timezone_set('Asia/Shanghai');
		$response = HttpClient::quickGet(self::SEND_URL,array(
            'CoreId'=>$paramArr['CoreId'],
			'Userid' => urlencode($username),
			'Password' => $password,
			//'period'   => 3,
			'Phone' => implode(';', $tonumbers),
			'Content' =>  urlencode($message),
			//'task' => microtime(1),
			//'day' => $time ? substr($time, 0, 10) : date('Y-m-d'),
			//'sendHour' => $time ? substr($time, 11, 2) : date('H'),
			//'sendMinute' => $time ? substr($time, 14, 2) : date('i'),
            'SendTime'=>$time,
		));
		switch($response){
			case -10:
				$success   = false;
				$err_msg = '�����ַ�����';
				break;
			case -20:
				$success   = false;
				$err_msg = '�û�û���ҵ��������';
				break;
			case -30:
				$success   = true;
				$err_msg = '����';
				break;
			case -40:
				$success   = false;
				$err_msg = 'ϵͳ���󣬷��ͺ���Ϊ��';
				break;
			case -50:
				$success   = false;
				$err_msg = 'ϵͳ���󣬷�������Ϊ��';
				break;
			default:
				$success   = true;
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
			$paramArr = json_decode($parameters);//ֻ֧��һά����,�������
			if(!is_array($paramArr))$paramArr=array();
		}
		$response = HttpClient::quickGet(self::BALANCE_URL,array(
            'CoreId'=>$paramArr['CoreId'],
		));
		return strip_tags($response);
	}
	
}
?>
