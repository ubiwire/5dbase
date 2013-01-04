<?php

class DefaultController extends Controller {

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User', array(
                    'criteria' => array(
//		        'condition'=>'status>'.User::STATUS_BANNED,
                        'condition' => 'status>' . User::STATUS_BANNED . ' and org_id=' . Yii::app()->user->org_id,
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->controller->module->user_page_size,
                    ),
                ));

        $this->render('/user/index', array(
            'dataProvider' => $dataProvider,
        ));
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

    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}