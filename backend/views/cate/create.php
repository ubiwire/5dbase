<?php
$this->breadcrumbs=array(
    Yii::t('category', 'Category') => array('index'),
    Yii::t('default', 'Create'),
);

//$this->menu=array(
//	array('label'=>'List Category','url'=>array('index')),
//	array('label'=>'Manage Category','url'=>array('admin')),
//);
$this->menu = array(
    array('label' => Yii::t('category', 'Category'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('category', 'Manage Category'), 'url' => array('admin')),
    //  array('label' => Yii::t('category', 'Manage Category'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('product', 'Product Menu'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('product', 'Manage Product'), 'url' => array('/product/admin')),
    array('label' => Yii::t('product', 'List Product'), 'url' => array('/product')),
      array('label' => Yii::t('product', 'Create Product'), 'url' => array('/product/create')),
);

?>
<div class="well">
<h3><?php echo Yii::t('category', 'Create Category') ?></h3>

<?php 
//Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully read this important alert message.');
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
	    'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    ),
));
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>