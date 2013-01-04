<?php
$this->layout = '//layouts/column2';
$this->breadcrumbs = array(
    Yii::t('default', 'member manage') => array('user'),
    // $model->username => array('view', 'id' => $model->id),
    Yii::t('default', 'Create'),
);



$this->menu = array(
    array('label' => Yii::t('default', 'member manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => UserModule::t('List User'), 'url' => array('/user/user')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'team tools'), 'url' => array('/news/admin')),
    array('label' => Yii::t('default', 'update team profile'), 'url' => array('/org/update')),
);
?>

<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo UserModule::t('Add User'); ?></legend>

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'product-form',
            'enableAjaxValidation' => false,
                ));
        ?>

<p class="help-block"><?php echo Yii::t('default', 'Fields with * are required.') ?></p>

        <?php echo $form->errorSummary($model); ?>
        <?php echo $form->textFieldRow($model, 'username'); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('hint' => UserModule::t("Minimal password length 4 symbols."))); ?>
        <?php echo $form->textFieldRow($model, 'tel'); ?>
        <?php echo $form->dropDownListRow($model, 'roles', User::itemAlias('UserRoles')); ?>
        <div class="form-actions">
            <?php
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