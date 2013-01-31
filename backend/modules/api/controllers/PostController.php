<?php

class PostController extends Controller {

    public function filters() {
        return array(
            array(
                'HttpAuthFilter',
                'users' => array('admin' => 'admin'),
                'realm' => 'Admin section'
            )
        );
    }

    public function actionList() {
        //  $user = Yii::app()->controller->module->_checkAuth();
        $user = Yii::app()->user;
        var_dump($user);
        
         Yii::app()->end();
        $models = array();
        if ($user->org_id) {
            $models = Post::model()->recentlyList($user->org_id);
        }
        // Did we get some results?
        $rows = array(); //output json
        if (empty($models)) {
            // No
            $rows['code'] = 1; //no data
            $rows['message'] = 'no data';
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
        } else {
            // Prepare response
            $rows['code'] = 0;
            $rows['message'] = 'ok';
            $data = array();
            foreach ($models as $model)
                $data[] = $model->attributes;
            // $data[] = $model->id;
            $rows['post'] = $data;
            // Send the response
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
        }
    }

}