<?php
$this->breadcrumbs = array(
    Yii::t('category', 'Category') => array('index'),
    Yii::t('default', 'Manage'),
);

//$this->menu=array(
//	array('label'=>'List Category','url'=>array('index')),
//	array('label'=>'Create Category','url'=>array('create')),
//);

$this->menu = array(
    array('label' => Yii::t('category', 'Category'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('category', 'Create Category'), 'url' => array('create')),
    //  array('label' => Yii::t('category', 'Manage Category'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('product', 'Product Menu'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('product', 'Manage Product'), 'url' => array('/product/admin')),
    array('label' => Yii::t('product', 'List Product'), 'url' => array('/product')),
    array('label' => Yii::t('product', 'Create Product'), 'url' => array('/product/create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('category-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="well">
    <h3><?php echo Yii::t('default', 'Manage Category') ?></h3>
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
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'category-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'id',
            'name',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    ));
    ?>
</div>
