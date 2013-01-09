<?php
$this->breadcrumbs=array(
	t('Sms')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	t('Update'),
);

$this->menu=array(
	array('label'=>t('List Sms'), 'url'=>array('index')),
	array('label'=>t('Create Sms'), 'url'=>array('create')),
	array('label'=>t('View Sms'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>t('Manage Sms'), 'url'=>array('admin')),
);
?>

<h1><?php echo t('Update Sms');?> # <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>