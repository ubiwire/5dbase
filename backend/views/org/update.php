<?php
/* @var $this OrgController */
/* @var $model Org */

$this->breadcrumbs=array(
	//'Orgs'=>array('index'),
	$model->name,
);

//$this->menu=array(
//	array('label'=>'List Org', 'url'=>array('index')),
//	array('label'=>'Create Org', 'url'=>array('create')),
//	array('label'=>'View Org', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Org', 'url'=>array('admin')),
//);
?>

<h1><?php echo Yii::t('org', 'update org'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>