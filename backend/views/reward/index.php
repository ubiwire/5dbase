<?php
$this->breadcrumbs=array(
	'Reward Points',
);

$this->menu=array(
	array('label'=>'Create RewardPoint','url'=>array('create')),
	array('label'=>'Manage RewardPoint','url'=>array('admin')),
);
?>

<h1>Reward Points</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
