<?php
$this->breadcrumbs=array(
	t('Sms')=>array('index'),
	t('Create'),
);

$this->menu=array(
	array('label'=>t('List Sms'), 'url'=>array('index')),
	array('label'=>t('Manage Sms'), 'url'=>array('admin')),
);
?>

<h1><?php echo t('Create Sms'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>