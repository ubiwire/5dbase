<?php
$this->breadcrumbs=array(
	t('Sms')=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>t('List Sms'), 'url'=>array('admin')),
	//array('label'=>t('Create Sms'), 'url'=>array('create')),
	//array('label'=>t('Update Sms'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>t('Delete Sms'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>t('Are you sure you want to delete this item?'))),
	array('label'=>t('Manage Sms'), 'url'=>array('admin')),
);
?>

<h1> <?php echo t('View Sms');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'from_uid',
			'value' => User::Model()->FindByPk($model->from_uid)->profile->lastname
			),
		array(
			'name' => 'to_uid',
			'value' => User::Model()->FindByPk($model->to_uid)->profile->lastname
			),
		'mobile',
		'content',
		'sendtime',
		'status',
		'remark',
	),
)); ?>
