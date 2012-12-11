<?php

class CommentController extends Controller {

    public function actionList($postId) {
       // Yii::app()->controller->module->_checkAuth();
//        var_dump (Yii::app()->getModule('api')->comment);
//        var_dump( Message::model()->findAll());
//        Yii::app()->end();
        $comment = new Comment();
       
        $comment->owner_name = 'Post';
        $comment->owner_id = $postId;
        $comment->getCommentsTree();
        $result = array();
        $result['code'] = 0;
        $result['comment_list'] = $comment->getCommentsTree();
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($result));
    }

    public function actionCreate($postId) {
        $user = Yii::app()->controller->module->_checkAuth();
        $result = array();
        $comment = new Comment();
        //需要发送parent_comment_id，如果直接评论post,则为0，如果对评论进行评论，这值为被评论的comment_id
        //<input name="Comment[parent_comment_id]"  value="0"> 
        //评论的内容，先不支持图片上传。
        //<textarea cols="60" rows="10" name="Comment[comment_text]" id="Comment_comment_text"></textarea>
        $comment->attributes = $_POST['Comment'];
        $comment->owner_id = $postId;
        $comment->owner_name = 'Post';
        $comment->creator_id = $user->id;
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