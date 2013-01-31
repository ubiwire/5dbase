<?php

class AccountController extends Controller {

    public function filters() {
        return array(
            array(
                'HttpAuthFilter',
                'users' => array('admin' => 'admin'),
                'realm' => 'Admin section'
            )
        );
    }

    public function actionVerifyCredentials() {
//        echo  $_SERVER['USER_ID'];
//        echo "====<br/>";
//         echo $_SERVER['ORG_ID'];
//          echo "====<br/>";
//          var_dump($_POST);
//        Yii::app()->end();
        $user = User::model()->findByPk($_SERVER['USER_ID']);
        $notice = Notice::twitterUserArray($user, true);
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($notice));
    }

}