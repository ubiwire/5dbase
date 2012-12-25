<?php
$this->breadcrumbs = array(
    Yii::t('default', 'team tools') => array('admin'),
//    $model->title => array('view', 'id' => $model->id),
    Yii::t('default', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('news', 'News'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('news', 'Create News'), 'url' => array('create')),
    array('label' => Yii::t('news', 'View News'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('news', 'Delete News'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('default', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('news', 'Manage News'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'User List'), 'url' => array('/user')),
);
?>
<div class="well">
    <h3><?php echo Yii::t('news', 'Update News'); ?></h3>

    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>