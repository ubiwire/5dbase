<?php

class PostController extends Controller
{
	public function actionList()
	{
		  Yii::app()->controller->module->_checkAuth();

		 $models = Post::model()->findAll();
		 // Did we get some results?
    if(empty($models)) {
        // No
        Yii::app()->controller->module->_sendResponse(200, 
                sprintf('No items where found for model post') );
    } else {
        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        Yii::app()->controller->module->_sendResponse(200, CJSON::encode($rows));
    }

		
	}
}