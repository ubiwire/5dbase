<?php
$this->breadcrumbs = array(
    Yii::t('product', 'Products') => array('index'),
    Yii::t('default', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('product', 'Product Menu'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('product', 'List Product'), 'url' => array('index')),
    array('label' => Yii::t('product', 'Create Product'), 'url' => array('create')),
    '---',
    array('label' => Yii::t('category', 'Category'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('category', 'Manage Category'), 'url' => array('/cate')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    #yw2_c1{width: 20px;}
    #yw2_c3{width: 80px;}
    #yw2_c4{width: 40px;}
    #yw2_c5{width: 60px;}
    #yw2_c6{width: 80px;}
    #yw2_c7{width: 80px;}
    .brand {font-size: 16px;}
</style>
<h3><?php echo Yii::t('product', 'Manage Product') ?></h3>
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
<!--<form action="/product/deleteall" method="post">
    <input type="submit" value="delete all" onclick="return confirm('asdfasdf')" />
</form>-->
<?php
//echo CHtml::beginForm('product/deleteall','post',array('id'=>'asdfasdapply-form'));
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
        // if grid doesn't have a checkbox column type, it will attach
        // one and this configuration will be part of it
        'checkBoxColumnConfig' => array(
            'name' => 'id'
        ),
    ),
    'columns' => array(
        'id',
        'name',
        'price',
        'inventory',
        array(
            'name' => 'status',
            'value' => 'Product::itemAlias("ProductStatus",$data->status)',
            'filter' => Product::itemAlias("ProductStatus"),
        ),
        array(
            'name' => 'category_id',
            'value' => '$data->category->name',
            'filter' => Category::getCategoryList(),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
//echo CHtml::endForm();
?>



<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
//    'id' => 'product-grid',
//    'dataProvider' => $model->search(),
//    'filter' => $model,
//    'columns' => array(
//        'id',
//        'name',
//        'price',
//        'inventory',
//        'category_id',
//        'status',
//        array(
//            'class' => 'bootstrap.widgets.TbButtonColumn',
//        ),
//    ),
//));
?>
