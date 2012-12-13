<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
     'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<!--<p class="help-block"><?php  echo Yii::t('default', 'Fields with * are required.')?></p>-->

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5')); ?>
<?php echo $form->textAreaRow($model, 'descriptor', array('rows' => 6, 'cols' => 30, 'class' => 'span7')); ?>
<?php echo $form->fileFieldRow($model, 'original_pic_path'); ?>
<?php echo $form->textFieldRow($model, 'inventory', array('class' => 'span5')); ?>
<?php echo $form->dropDownListRow($model, 'category_id', $categoryList);
?>

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
