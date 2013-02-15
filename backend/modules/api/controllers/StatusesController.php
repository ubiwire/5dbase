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

    /* 返回未设置私密的用户 ( 必须有自定义的用户头像 ) 的最近20条消息，该方法不需要身份认证。
     * 访问地址：http://api.twitter.com/statuses/public_timeline.format
     */

    public function actionPublic_timeline() {
        $org = Org::model()->findByPk($_SERVER['ORG_ID']);
        $notices = $org->notices;
//        var_dump($notcies[0]->attributes);
//        Yii::app()->end();
        $statuses = array();
        foreach ($notices as $notice) {
            try {
                $twitter_status = $notice->showNotice();
                array_push($statuses, $twitter_status);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                Yii::app()->end();
            }
        }
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($statuses));
    }

    /* 显示20条最近的对用户的回复消息， ( 消息前缀为 @username ) 。该API只开放给认证用户，请求其他用户的收到的回复消息列表是非法的，无论其      * 他用户设置私密与否。
     * 访问地址：http://api.twitter.com/statuses/replies.format
     * since_id. 可选参数. 返回ID比数值since_id大（比since_id时间晚的）的提到。
      　　 *示例: http://api.twitter.com/statuses/mentions.xml?since_id=12345
      　　 *max_id. 可选参数. 返回ID不大于max_id(时间不晚于max_id)的提到。
      　　 *示例: http://api.twitter.com/statuses/mentions.xml?max_id=54321
      　　 *count. 可选参数. 每次返回的最大记录数（即页面大小），不大于200，默认为20。
      　　 *示例: http://api.twitter.com/statuses/mentions.xml?count=200
      　　 *page. 可选参数. 返回结果的页序号。注意：有分页限制。
      　　 *示例: http://api.twitter.com/statuses/mentions.xml?page=3
     */

    public function actionMentions() {
//        echo $_SERVER['USER_ID'];
//        echo "====<br/>";
//        echo $_SERVER['ORG_ID'];
//        echo "====<br/>";
//        Yii::app()->end(); 
        $user = User::model()->findByPk($_SERVER['USER_ID']);
        if ($user) {
            //可以接受参数 查询出符合条件的mentions，先简单那最近的20条
            $notices = $user->mentions();
           // var_dump($notices);
//            echo count($notices);
//            Yii::app()->end();
            $statuses = array();
            foreach ($notices as $notice) {
                try {
                    $twitter_status = $notice->showNotice();
                    array_push($statuses, $twitter_status);
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                    Yii::app()->end();
                }
            }
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($statuses));
        } else {
            Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('No such user.')), 'application/json; charset=utf-8');
        }
    }

    /* 返回指定Id的一条消息，返回信息中包含作者信息。
     * 访问地址：http://api.twitter.com/statuses/show/id.format或者
     * http://api.twitter.com/statuses/show.format?id={id}
     * id. 必须参数(微博信息ID)，要获取已发表的微博ID,如ID不存在返回空
     */

    public function actionShow($id) {
//        echo $_SERVER['USER_ID'];
//        echo "====<br/>";
//        echo $_SERVER['ORG_ID'];
//        echo "====<br/>";
//        echo $id;
//        Yii::app()->end();
        $notice = Notice::model()->findByPk($id);
        if (is_null($notice)) {
            Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('No status with that ID found..')), 'application/json; charset=utf-8');
        } else {
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($notice->showNotice()));
        }
    }

    public function actionDestroy() {
//          echo $_SERVER['USER_ID'];
//        echo "====<br/>";
//        echo $_SERVER['ORG_ID'];
//        echo "====<br/>";
//       // echo $id;
//        Yii::app()->end();
        if (!isset($_POST['id'])) {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('id requred.')), 'application/json; charset=utf-8');
        }

        if (!in_array($_SERVER['REQUEST_METHOD'], array('POST', 'DELETE'))) {
            Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('This method requires a POST or DELETE.')), 'application/json; charset=utf-8');
        }

        $notice = Notice::model()->findByPk($_POST['id']);
        if (is_null($notice)) {
            Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('No status with that ID found..')), 'application/json; charset=utf-8');
        }

        if ($_SERVER['USER_ID'] == $notice->user_id) {
            $status = $notice->showNotice();
            $notice->delete();
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($status));
        } else {
            Yii::app()->controller->module->_sendResponse(403, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('You may not delete another user\'s status.')), 'application/json; charset=utf-8');
        }
    }

    /* 更新认证用户的消息，必须包含content参数，且必须以POST方式请求。 成功时按指定格式返回当前的消息。
     * 访问地址：http://api.twitter.com/statuses/update.format
     * status. 必填参数， 要更新的微博信息。必须做URLEncode,信息内容部超过140个汉字,为空返回400错误。
      　　 *in_reply_to_status_id. 可选参数，@ 需要回复的微博信息ID, 这个参数只有在微博内容以 @username 开头才有意义。
      　　 *lat. 可选参数，纬度，发表当前微博所在的地理位置，有效范围 -90.0到+90.0, +表示北纬。只有用户设置中geo_enabled=true时候地理位置才有效。
      　　 *long. 可选参数，经度。有效范围-180.0到+180.0, +表示东经。
     */

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
            $notice = Notice::saveNew($_SERVER['USER_ID'], $_SERVER['ORG_ID'], $lat, $lon, $content, $options);
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