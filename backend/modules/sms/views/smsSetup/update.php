<?php
$this->breadcrumbs=array(
	t('Sms Setups')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	t('Update'),
);

$this->menu=array(
	array('label'=>t('List SmsSetup'), 'url'=>array('index')),
	array('label'=>t('Create SmsSetup'), 'url'=>array('create')),
	//array('label'=>t('View SmsSetup'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>t('Manage SmsSetup'), 'url'=>array('admin')),
);
?>

<h1><?php echo t('Update SmsSetup');?> # <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>