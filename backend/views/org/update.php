<?php
/* @var $this OrgController */
/* @var $model Org */

$this->breadcrumbs = array(
    //'Orgs'=>array('index'),
    Yii::t('default', 'team manage') => array('/user/user'),
    $model->name,
);

//$this->menu=array(
//	array('label'=>'List Org', 'url'=>array('index')),
//	array('label'=>'Create Org', 'url'=>array('create')),
//	array('label'=>'View Org', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Org', 'url'=>array('admin')),
//);
$this->menu = array(
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'member manage'), 'url' => array('/user/user')),
    '---',
    array('label' => Yii::t('news', 'News'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('news', 'Create News'), 'url' => array('/news/create')),
    array('label' => Yii::t('news', 'Manage News'), 'url' => array('/news/admin')),
);
?>

<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo Yii::t('org', 'update org'); ?></legend>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </fieldset>
</div>