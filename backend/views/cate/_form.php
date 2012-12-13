<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'category-form',
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block"><?php  echo Yii::t('default', 'Fields with * are required.')?></p>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 25)); ?>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ?  Yii::t('default', 'Create') : Yii::t('default', 'Save'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
