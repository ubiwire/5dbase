<?php

class StatusesController extends Controller {

    public function filters() {
        return array(
            array(
                'HttpAuthFilter',
                'users' => array('admin' => 'admin'),
                'realm' => 'Admin section'
            )
        );
    }

    public function actionUpdate() {
//        echo  $_SERVER['USER_ID'];
//        echo "====<br/>";
//         echo $_SERVER['ORG_ID'];
//          echo "====<br/>";
//          var_dump($_POST);
//        Yii::app()->end();
        //判断请求
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"This method requires a POST."')), 'application/json; charset=utf-8');
        }
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $in_reply_to_status_id = isset($_POST['in_reply_to_status_id']) ? $_POST['in_reply_to_status_id'] : '';
        $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
        $lon = isset($_POST['lon']) ? $_POST['lon'] : '';
        $reply_to = null;
        $options = array();

        if (empty($status)) {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('Client must provide a \'status\' parameter with a value.')), 'application/json; charset=utf-8');
        }

        if (Notice::contentTooLong($status)) {
            // Note: Twitter truncates anything over 140, flags the status
            // as "truncated."
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('That\'s too long. Maximum notice size is 140 character.')), 'application/json; charset=utf-8');
        }

        if (!empty($in_reply_to_status_id)) {
            $reply = Notice::model()->findByPk($in_reply_to_status_id);
            if ($reply) {
                $reply_to = $in_reply_to_status_id;
                $options = array('reply_to' => (int) $reply_to);
            } else {
                Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('Parent notice not found.')), 'application/json; charset=utf-8');
            }
        }

        $content = html_entity_decode($status, ENT_NOQUOTES, 'UTF-8');

        try {
            $notice = Notice::saveNew($_SERVER['USER_ID'], $_SERVER['ORG_ID'],$lat, $lon, $content, $options);
        } catch (Exception $e) {
//            Yii::app()->controller->module->_sendResponse($e->getCode(), Yii::app()->controller->module->_getErrorForRequest($e->getMessage()), 'application/json; charset=utf-8');
       
            Yii::app()->controller->module->_sendResponse($e->getCode(), CJSON::encode(Yii::app()->controller->module->_getErrorForRequest($e->getMessage())), 'application/json; charset=utf-8');
        }

//        $notice->showNotice();
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($notice->showNotice()));

//        $models = array();
//        if ($_SERVER['ORG_ID']) {
//            $models = Post::model()->recentlyList($_SERVER['ORG_ID']);
//        }
//        // Did we get some results?
//        $rows = array(); //output json
//        if (empty($models)) {
//            // No
//            $rows['code'] = 1; //no data
//            $rows['message'] = 'no data';
//            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
//        } else {
//            // Prepare response
//            $rows['code'] = 0;
//            $rows['message'] = 'ok';
//            $data = array();
//            foreach ($models as $model)
//                $data[] = $model->attributes;
//            // $data[] = $model->id;
//            $rows['post'] = $data;
//            // Send the response
//            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
//        }
    }

}