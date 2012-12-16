<?php
$this->breadcrumbs=array(
	'Reward Grants'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RewardGrant','url'=>array('index')),
	array('label'=>'Create RewardGrant','url'=>array('create')),
	array('label'=>'View RewardGrant','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RewardGrant','url'=>array('admin')),
);
?>

<h1>Update RewardGrant <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>