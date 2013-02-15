<?php

class FavoritesController extends Controller {

    public $defaultAction = 'index';

    public function filters() {
        return array(
            array(
                'HttpAuthFilter',
                'users' => array('admin' => 'admin'),
                'realm' => 'Admin section'
            )
        );
    }

    /* api/favorites.json
      返回授权用户的最新的20条收藏的状态信息。也可以通过id或者用户名来指定一个用户，查询他最新的20条收藏的状态信息
      访问地址：http://api.twitter.com/favorites.format
      　　参数列表：
      　　page： 可选参数. 返回结果的页序号。注意：有分页限制。
      　　示例: http://api.twitter.com/favorites/11075.json?page=3
     */

    public function actionIndex($id, $page) {
//        echo "hello in index";
//        echo $id;
//        echo "<br/>";
//        echo $page;
//        Yii::app()->end();
        $user_id = $_SERVER['USER_ID'];
        $Favortes_page = 1;
        if (isset($id)) {
            $user_id = $id;
        }
        if (isset($page)) {
            $Favortes_page = $page;
        }
        
    }

    /*
     * 收藏一条状态信息POST提交
      　　 * 访问地址：
      　　 * http://api.twitter.com/favorites/create.format
     * id 必须，授权用户要收藏的状态信息id
     */

    public function actionCreate() {
//        echo "asdf";
//        Yii::app()->end();
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"This method requires a POST."')), 'application/json; charset=utf-8');
        }
        //有效的notice_id
        $notice = null;
        if (isset($_POST['id'])) {
            $notice = Notice::model()->findByPk($_POST['id']);
            if (is_null($notice)) {
                Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"No status found with that ID."')), 'application/json; charset=utf-8');
            }
        } else {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"This method requires with ID."')), 'application/json; charset=utf-8');
        }

        $user = User::model()->findByPk($_SERVER['USER_ID']);

        //已经喜欢过的Notce
        if ($user->hasFave($notice)) {
            Yii::app()->controller->module->_sendResponse(403, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"his status is already a favorite."')), 'application/json; charset=utf-8');
        }

        $fave = new Fave();
        $fave->user_id = $user->id;
        $fave->notice_id = $notice->id;
        $fave->modified = strftime('%Y-%m-%d %H:%M:%S', time());
        //关于uri 先不做处理
        $fave->uri = 'tag:localhost,2013-01-11:statusnet:favor:1:2:2013-01-11T14:10:29+00:00';
//            $fave->uri       = self::newURI($fave->user_id,
//                                            $fave->notice_id,
//                                            $fave->modified);
        if ($fave->save()) {
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($notice->showNotice()));
        } else {
            Yii::app()->controller->module->_sendResponse(403, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"Could not create favorite."')), 'application/json; charset=utf-8');
        }
    }

    /* 删除授权用户收藏的一条状态信息
      　　 *访问地址：http://api.twitter.com/favorites/destroy/id.format
     * id 授权用户收藏的状态信息id
     */

    public function actionDestroy() {
        //有效的notice_id
        $notice = null;
        if (isset($_POST['id'])) {
            $notice = Notice::model()->findByPk($_POST['id']);
            if (is_null($notice)) {
                Yii::app()->controller->module->_sendResponse(404, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"No status found with that ID."')), 'application/json; charset=utf-8');
            }
        } else {
            Yii::app()->controller->module->_sendResponse(400, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"This method requires with ID."')), 'application/json; charset=utf-8');
        }
        $user = User::model()->findByPk($_SERVER['USER_ID']);

        //已经喜欢过的Notice才可以删除
        if ($user->hasFave($notice)) {
            $fave = Fave::model()->find('user_id=:user_id and notice_id=:notice_id', array(':user_id' => $user->id, ':notice_id' => $notice->id));
            $fave->delete();
            Yii::app()->controller->module->_sendResponse(200, CJSON::encode($notice->showNotice()));
        } else {
            Yii::app()->controller->module->_sendResponse(403, CJSON::encode(Yii::app()->controller->module->_getErrorForRequest('"Could not delete favorite."')), 'application/json; charset=utf-8');
        }
    }

}