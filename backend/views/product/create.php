<?php
$this->breadcrumbs=array(
	Yii::t('product', 'Products') =>array('index'),
	Yii::t('default', 'Create'),
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('product','Create Product'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>