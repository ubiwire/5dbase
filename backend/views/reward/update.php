<?php
$this->breadcrumbs=array(
	'Reward Points'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RewardPoint','url'=>array('index')),
	array('label'=>'Create RewardPoint','url'=>array('create')),
	array('label'=>'View RewardPoint','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RewardPoint','url'=>array('admin')),
);
?>

<h1>Update RewardPoint <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>