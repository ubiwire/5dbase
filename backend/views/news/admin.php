<?php
$this->breadcrumbs = array(
    Yii::t('news', 'News') => array('admin'),
    Yii::t('default', 'Manage'),
);

$this->menu = array(
     array('label' => Yii::t('news', 'News'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('news', 'Create News'), 'url' => array('create')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
     array('label' => Yii::t('default', 'User List'), 'url' => array('/user')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    #yw2_c1{width: 20px;}
    #yw2_c2{width: 80px;}
    #yw2_c4{width: 80px;}
    #yw2_c5{width: 80px;}
</style>
<div class="well">
    <h3><?php echo Yii::t('news', 'Manage News') ?></h3>
    <p>
        <?php echo Yii::t('default', 'You may optionally enter a comparison operator (&lt;,&lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.') ?>
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
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered',
    'filter' => $model,
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'bulkActions' => array(
        'actionButtons' => array(
                array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'size' => 'small',
                'label' => Yii::t('default', 'delete all'),
                'click' => 'js:bootbox.confirm("Are you sure?")'
            )
        ),
        'checkBoxColumnConfig' => array(
            'name' => 'id'
        ),
    ),
    'columns' => array(
        'id',
        'title',
        'content',
        array(
            'name' => 'news_type',
            'value' => 'News::itemAlias("NewsType",$data->news_type)',
            'filter' => News::itemAlias("NewsType"),
        ),
       
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
    
    
//    $this->widget('bootstrap.widgets.TbGridView', array(
//        'id' => 'news-grid',
//        'dataProvider' => $model->search(),
//        'filter' => $model,
//        'columns' => array(
//            'id',
//            'news_type',
//            'title',
//            'content',
//            array(
//                'class' => 'bootstrap.widgets.TbButtonColumn',
//            ),
//        ),
//    ));
    ?>
</div>