<?php

class UserController extends Controller {

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return CMap::mergeArray(parent::filters(), array(
                    'accessControl', // perform access control for CRUD operations
                ));
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'console', 'update', 'create', 'delete'),
//				'users'=>array('*'),
                'roles' => array('manager'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionCreate() {
        $model = new CreateUser;
        $profile = new Profile;
        if (isset($_POST['CreateUser'])) {
            $model->attributes = $_POST['CreateUser'];
//            $profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
//            if ($model->validate() && $profile->validate()) {
//            echo $model->roles;
//            Yii::app()->end();
            if ($model->validate()) {
//                Yii::app()->end();
                $model->activkey = UserModule::encrypting(microtime() . $model->password);
                $model->password = UserModule::encrypting($model->password);
                $model->superuser = 0;
                $model->status = 1;
                $model->org_id = Yii::app()->user->org_id;
                // 防止恶意修改参数
                if ($_POST['CreateUser']['roles'] == 'admin') {
                    $model->roles = 'member';
                } else {
                    $model->roles = $_POST['CreateUser']['roles'];
                }
                if ($model->save()) {
                    $profile->user_id = $model->id;
                    $profile->save(false);
                    $this->redirect(array('/user/user'));
                }
            }
        }
        $this->render('create', array('model' => $model, 'profile' => $profile));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($_POST['User']['roles'] == 'admin') {
                $model->roles = 'member';
            } else {
                $model->roles = $_POST['User']['roles'];
            }
            if ($model->save())
                $this->redirect(array('/user/user'));
        }

        $this->render('/user/update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
//            $this->loadModel($id)->delete();
            // you can't delete your self
            if ($id == Yii::app()->user->id) {
                Yii::app()->user->setFlash('info', UserModule::t('you can\'t delete your self'));
                //给出提示，目前还没有做到，原生态的ajax可以实现，在这里不知道怎么用。先留着
            } else {
                $model = $this->loadModel($id);
                $model->org_id = 0;//不属于任何组织，，游离状态
                $model->save();
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $model = $this->loadModel();
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User', array(
                    'criteria' => array(
                        'condition' => 'status>' . User::STATUS_BANNED . ' and org_id=' . Yii::app()->user->org_id,
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->controller->module->user_page_size,
                    ),
                ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = User::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser($id = null) {
        if ($this->_model === null) {
            if ($id !== null || isset($_GET['id']))
                $this->_model = User::model()->findbyPk($id !== null ? $id : $_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

}
