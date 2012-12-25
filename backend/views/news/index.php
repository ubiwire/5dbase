<?php
$this->breadcrumbs=array(
	Yii::t('default', 'team tools'),
);

$this->menu=array(
	array('label'=>Yii::t('news', 'Create News'),'url'=>array('create')),
	array('label'=>Yii::t('news', 'Manage News'),'url'=>array('admin')),
);
?>

<div class="well">
<h3>News</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>