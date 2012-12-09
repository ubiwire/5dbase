<?php

class LoginController extends Controller
{
	public function actionIndex()
	{
		Yii::app()->controller->module->_checkAuth();
		$rows= array();
		$rows['code'] = 0;
		Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
	}
}