<?php
$this->breadcrumbs=array(
	'Reward Grants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RewardGrant','url'=>array('index')),
	array('label'=>'Manage RewardGrant','url'=>array('admin')),
);
?>

<h1>Create RewardGrant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>