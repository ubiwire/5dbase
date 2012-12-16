<?php
$this->breadcrumbs=array(
	'Reward Points'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RewardPoint','url'=>array('index')),
	array('label'=>'Create RewardPoint','url'=>array('create')),
	array('label'=>'Update RewardPoint','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete RewardPoint','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RewardPoint','url'=>array('admin')),
);
?>

<h1>View RewardPoint #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'total',
		'usage',
		'org_id',
		'status',
		'create_at',
		'update_at',
	),
)); ?>
