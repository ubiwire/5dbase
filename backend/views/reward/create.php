<?php
$this->breadcrumbs=array(
	'Reward Points'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RewardPoint','url'=>array('index')),
	array('label'=>'Manage RewardPoint','url'=>array('admin')),
);
?>

<h1>Create RewardPoint</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>