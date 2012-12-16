<?php
$this->breadcrumbs=array(
	'Reward Grants'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RewardGrant','url'=>array('index')),
	array('label'=>'Create RewardGrant','url'=>array('create')),
	array('label'=>'Update RewardGrant','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete RewardGrant','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RewardGrant','url'=>array('admin')),
);
?>

<h1>View RewardGrant #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'org_id',
		'granter_id',
		'integral_id',
		'recipient_id',
		'integral_val',
		'granter_type',
		'usage',
		'create_at',
		'update_at',
	),
)); ?>
