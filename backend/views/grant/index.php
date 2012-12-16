<?php
$this->breadcrumbs=array(
	'Reward Grants',
);

$this->menu=array(
	array('label'=>'Create RewardGrant','url'=>array('create')),
	array('label'=>'Manage RewardGrant','url'=>array('admin')),
);
?>

<h1>Reward Grants</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
