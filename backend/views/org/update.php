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

<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo Yii::t('org', 'update org'); ?></legend>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </fieldset>
</div>