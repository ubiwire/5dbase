<?php
$this->breadcrumbs=array(
	Yii::t('reward', 'Reward Points')=>array('index'),
	Yii::t('default', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('reward', 'List RewardPoint'),'url'=>array('index')),
	array('label'=>Yii::t('reward', 'Manage RewardPoint'),'url'=>array('admin')),
);
?>

<?php 
//Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully read this important alert message.');
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
	    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    ),
));
?>
<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo Yii::t('reward', 'Create RewardPoint'); ?></legend>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </fieldset>
</div>