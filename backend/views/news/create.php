<?php
$this->breadcrumbs=array(
	Yii::t('default', 'team tools') =>array('index'),
	Yii::t('default', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('news', 'List News'),'url'=>array('index')),
	array('label'=>Yii::t('news', 'Manage News'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('news', 'Create News') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>