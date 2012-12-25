<?php
$this->breadcrumbs = array(
    Yii::t('default', 'team tools') => array('admin'),
    Yii::t('default', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('news', 'News'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('news', 'Manage News'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'User List'), 'url' => array('/user')),
);
?>
<div class="well">
    <h3><?php echo Yii::t('news', 'Create News') ?></h3>

    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>