<?php

class CommentController extends Controller {

    public function actionCreate($postId) {
        $user = Yii::app()->controller->module->_checkAuth();
        $result = array();
        $comment = new Comment();
        $comment->attributes = $_POST['Comment'];
        if ($comment->save()) {
            $result['code'] = 0;
        } else {
            $result['code'] = 1;
            $result['message'] = 'save faild';
        }
        // Yii::app()->end();
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($result));
    }

}