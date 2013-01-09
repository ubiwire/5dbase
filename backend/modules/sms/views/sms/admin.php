<?php
$this->breadcrumbs=array(
	t('Sms')=>array('index'),
	t('Manage'),
);

$this->menu=array(
	array('label'=>t('Manage Sms'), 'url'=>array('admin')),
	//array('label'=>t('Manage Smssetup'), 'url'=>array('smssetup/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sms-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>  <?php echo t("Manage Sms");?></h1>

<p class="infoBar" ><?php echo t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?> 
</p>

<?php //echo CHtml::link(t("Advanced Search"),"#",array("class"=>"search-button")); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
					'name' => 'from_uid',
					'value' => 'User::Model()->FindByPk($data->from_uid)->profile->lastname'
					),
		array(
					'name' => 'to_uid',
					'value' => 'User::Model()->FindByPk($data->to_uid)->profile->lastname'
					),
		//'mobile',
		'content',
		'sendtime',
		/*
		'status',
		'remark',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {delete}'            
		),
	),
)); ?>
