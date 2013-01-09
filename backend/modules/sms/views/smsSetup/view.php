<?php
$this->breadcrumbs=array(
	t('Sms Setups')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>t('List SmsSetup'), 'url'=>array('index')),
	array('label'=>t('Create SmsSetup'), 'url'=>array('create')),
	array('label'=>t('Update SmsSetup'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>t('Delete SmsSetup'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>t('Are you sure you want to delete this item?'))),
	array('label'=>t('Manage SmsSetup'), 'url'=>array('admin')),
);
?>

<h1> <?php echo t('View SmsSetup');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'providertype',
		'parameters',
		array(
			'name' => 'isactive',
			'value' => SmsSetup::itemAlias("isActive",$model->isactive),
			)
	),
)); ?>
