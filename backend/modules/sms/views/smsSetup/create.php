<?php
$this->breadcrumbs=array(
	t('Sms Setups')=>array('index'),
	t('Create'),
);

$this->menu=array(
	array('label'=>t('List SmsSetup'), 'url'=>array('index')),
	array('label'=>t('Manage SmsSetup'), 'url'=>array('admin')),
	array('label'=>t('Manage Sms'), 'url'=>array('/sms/sms/admin')),
);
?>

<h1><?php echo t('Create SmsSetup'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>