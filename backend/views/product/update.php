<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('default','Update'),
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'View Product','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo Yii::t('product', 'Update Product'); ?></legend>
        <?php echo $this->renderPartial('_form', array('model' => $model, 'categoryList' => $categoryList)); ?>
    </fieldset>
</div>