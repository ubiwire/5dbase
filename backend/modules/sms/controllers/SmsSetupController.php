<?php

class SmsSetupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function filters() { return array( 'rights', ); } 

	public function allowedActions() { return 'index,view'; }

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','balance','ajaxUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionCreate()
	{
		$model=new SmsSetup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SmsSetup']))
		{
			$model->attributes=$_POST['SmsSetup'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SmsSetup']))
		{
			$model->attributes=$_POST['SmsSetup'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
                $this->redirect(array('admin'));//������ɺ���ת������ҳ update by yichao
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
            $smsObj = SmsSetup::model()->findByPk($id);
			// we only allow deletion via POST request
			if($smsObj->isactive)$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}*/

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SmsSetup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SmsSetup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmsSetup']))
			$model->attributes=$_GET['SmsSetup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SmsSetup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sms-setup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionAjaxUpdate(){
        //$criteria=new CDbCriteria();
	    //$criteria->addInCondition('id', $_POST['user-id']);
        $id = $_GET['id'];
        if($id){
            //var_dump(Yii::app()->session['currentSchool']);exit();
            $school_id = SmsSetup::model()->findByPk($id)->school_id;
            
            SmsSetup::model()->updateAll(array('school_id'=>$school_id,'isactive'=>1));
            SmsSetup::model()->updateByPk($id,array('isactive'=>0)); 
            Yii::app()->end();  
        }
        
    }
    
    /**
     * ��ѯ���
     * yichao
     * */
    public function actionBalance()
	{
		$sms_obj = SmsSetup::model()->findAll('isactive = 0');
		if($sms_obj){
			Yii::import('application.modules.sms.components.provider.'.$sms_obj[0]->providertype);
			$serb_obj = new $sms_obj[0]->providertype;
		    return	$return_val = $serb_obj->getBalance($sms_obj[0]->username, $sms_obj[0]->password,$sms_obj[0]->parameters);
		}
	}
}
