<?php
$this->breadcrumbs=array(
	Yii::t('reward', 'Reward Grants'),
//	Yii::t('reward', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('reward', 'Create RewardPoint'), 'url' => array('/reward/create')),
    array('label' => Yii::t('reward', 'List RewardPoint'), 'url' => array('/reward')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reward-grant-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="well">
<h3><?php echo Yii::t('reward', 'Reward Grants'); ?></h3>

<p>
    <?php echo Yii::t('default', 'You may optionally enter a comparison operator (&lt;,&lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.'); ?>

</p>

<?php echo CHtml::link(Yii::t('default', 'Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'reward-grant-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',

		'granter_id',
		'recipient_id',
		'reward_val',
		'granter_type',
		/*
		'usage',
		'create_at',
		'update_at',
		'reason',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</div>