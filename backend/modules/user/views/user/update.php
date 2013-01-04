<?php
$this->layout = '//layouts/column2';
$this->breadcrumbs = array(
   Yii::t('default', 'member manage') => array('user'),
   // $model->username => array('view', 'id' => $model->id),
    Yii::t('default', 'Update'),
);



$this->menu = array(
    array('label' => Yii::t('default', 'member manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => UserModule::t( 'Add User'), 'url' => array('create')),
    array('label' => UserModule::t( 'Delete User'),  'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('default', 'Are you sure you want to delete this item?'))),
    array('label' => UserModule::t( 'List User'), 'url' => array('/user/user')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'team tools'), 'url' => array('/news/admin')),
    array('label' => Yii::t('default', 'update team profile'), 'url' => array('/org/update')),
);
?>

<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo UserModule::t('Update User'); ?></legend>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
        ));
?>

<!--<p class="help-block"><?php echo Yii::t('default', 'Fields with * are required.') ?></p>-->

<?php echo $form->errorSummary($model); ?>
        <?php echo $form->uneditableRow($model, 'username'); ?>
        <?php echo $form->dropDownListRow($model, 'roles', User::itemAlias('UserRoles')); ?>
        <div class="form-actions">
<?php

//$this->widget('ext.editable.EditableField', array(
//    'type'      => 'select',
//    'model'     => $model,
//    'attribute' => 'username',
//    'url'       => $this->createUrl('user/update'),
//   // 'source'    => CHtml::listData(Group::model()->findAll(), 'group_id', 'group_name')
//    'source' => User::itemAlias("UserRoles")
//));

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'label' => $model->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save'),
));
?>
        </div>

<?php $this->endWidget(); ?>


    </fieldset>
</div>