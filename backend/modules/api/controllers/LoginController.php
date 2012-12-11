<?php

class LoginController extends Controller
{
	public function actionIndex()
	{
		$user = Yii::app()->controller->module->_checkAuth();
		$rows= array();
		$rows['code'] = 0;
                $rows['org'] = $user->org->name;
		Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
	}
}