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

}