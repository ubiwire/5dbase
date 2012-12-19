<?php
$this->breadcrumbs = array(
    Yii::t('reward', 'Reward Points') => array('index'),
    Yii::t('default', 'Manage'),
);

$this->menu = array(
//    array('label' => 'List RewardPoint', 'url' => array('index')),
    array('label' => Yii::t('reward', 'Create RewardPoint'), 'url' => array('create')),
    array('label' => Yii::t('reward', 'RewardGrant detail'), 'url' => array('grant')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reward-point-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
  
    #reward-point-grid_c4{width: 60px;}
    
</style>
<h3><?php echo Yii::t('reward', 'Manage Reward Points') ?></h3>

<p>
    <?php echo Yii::t('default', 'You may optionally enter a comparison operator (&lt;,&lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
</p>

<?php echo CHtml::link(Yii::t('default', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'reward-point-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'date',
            'value' => 'date("Y-m", $data->date)',
        ),
        'total',
        'usage',
         array(
            'name' => 'status',
            'value' => 'RewardPoint::itemAlias("RewardPointStatus",$data->status)',
            'filter' => RewardPoint::itemAlias("RewardPointStatus"),
        ),
       /* 'org_id',
          'create_at',
          'update_at',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
